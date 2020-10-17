<?php
namespace app\Component\Validate;


class Validator
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [];

    /**
     * 验证提示信息
     * @var array
     */
    protected $message = [];

    /**
     * 默认规则提示
     * @var array
     */
    protected static $typeMsg = [
        //is 判断
        'require'  => ':attribute 不能为空',
        'number'   => ':attribute 必须是数字',
        'integer'  => ':attribute 必须是整数',
        'float'    => ':attribute 必须是浮点数',
        'boolean'  => ':attribute 必须是布尔值',
        'accepted' => ':attribute 必须是yes、on或者1',
        'email'    => ':attribute 不是合法的邮箱格式',
        'mobile'   => ':attribute 不是合法的手机号码格式',
        'url'      => ':attribute 不是有效的URL地址',
        'array'    => ':attribute 必须是数组',
        'date'     => ':attribute 不是一个有效的日期格式',
        'alpha'       => ':attribute 只能是字母',
        'alphaNum'    => ':attribute 只能是字母和数字',
        'alphaDash'   => ':attribute 只能是字母、数字和下划线_及破折号-',
        'chs'         => ':attribute 只能是汉字',
        'chsAlpha'    => ':attribute 只能是汉字、字母',
        'chsAlphaNum' => ':attribute 只能是汉字、字母和数字',
        'chsDash'     => ':attribute 只能是汉字、字母、数字和下划线_及破折号-',
        //定义方法判断
        'in'          => ':attribute必须在 :rule 范围内',
        'notIn'       => ':attribute不能在 :rule 范围内',
        'between'     => ':attribute只能在 :1 - :2 之间',
        'notBetween'  => ':attribute不能在 :1 - :2 之间',
        'length'      => ':attribute长度不符合要求 :rule',
        'max'         => ':attribute长度不能超过 :rule',
        'min'         => ':attribute长度不能小于 :rule',
        'after'       => ':attribute日期不能小于 :rule',
        'before'      => ':attribute日期不能超过 :rule',
        'different' => ':attribute和比较字段:2不能相同',
        'egt'       => ':attribute必须大于等于 :rule',
        'gt'        => ':attribute必须大于 :rule',
        'elt'       => ':attribute必须小于等于 :rule',
        'lt'        => ':attribute必须小于 :rule',
        'eq'        => ':attribute必须等于 :rule',
        'regex'      => ':attribute不符合指定规则',
        'dateFormat' => ':attribute必须使用日期格式 :rule',
        'ip'         => ':attribute不是有效的IP地址',
        //其他自定义
    ];

    /**
     * Filter_var 规则
     * @var array
     */
    protected $filter = [
        'email'   => FILTER_VALIDATE_EMAIL,
        'ip'      => [FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6],
        'integer' => FILTER_VALIDATE_INT,
        'url'     => FILTER_VALIDATE_URL,
        'macAddr' => FILTER_VALIDATE_MAC,
        'float'   => FILTER_VALIDATE_FLOAT,
    ];

    /**
     * 内置正则验证规则
     * @var array
     */
    protected $regex = [
        'alphaDash'   => '/^[A-Za-z0-9\-\_]+$/',
        'chs'         => '/^[\x{4e00}-\x{9fa5}]+$/u',
        'chsAlpha'    => '/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',
        'chsAlphaNum' => '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u',
        'chsDash'     => '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9\_\-]+$/u',
        'mobile'      => '/^1[3-9][0-9]\d{8}$/',
        'idCard'      => '/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$)/',
        'zip'         => '/\d{6}/',
    ];

    /**
     * 验证错误提示信息
     * @var array
     */
    protected $error = [];

    public function __construct()
    {

    }

    /**
     * 设置提示信息
     * @access public
     *
     * @param  string|array $name    字段名称
     * @param  string       $message 提示信息
     *
     * @return Validate
     */
    public function getMessage($name, $message = '')
    {
        return $this->message;
    }

    /**
     * 获取错误信息
     */
    public function getError()
    {
        return $this->error;
    }

    public function isSuccess()
    {
        return !empty($this->error) ? false : true;
    }

    /**
     * 数据自动验证
     *
     * @param       $data     数据
     * @param array $rules    验证规则
     * @param array $messages 错误信息
     *
     * @return $this
     * @throws UnprocessableEntityHttpException
     * @throws \Exception
     */
    public function validate($data, $rules = [], $messages = [])
    {
        $this->error   = [];
        $this->message = array_merge($this->message, $messages);
        foreach ($rules as $key => $rule) {
            if (!is_array($rule)) {
                throw new \Exception('the rules of ' . $key . ' must be array');
            } else {
                if (strpos($key, '|')) {
                    // 字段|描述 用于指定属性名称
                    list($key, $title) = explode('|', $key);
                } else {
                    $title = '';
                }
                $value  = $this->getDataValue($data, $key);
                $result = $this->validateItem($key, $value, $rule, $data, $title);
            }
            if (true !== $result) {
                // 没有返回true 则表示验证失败
                if (is_array($result)) {
                    $this->error = array_merge($this->error, $result);
                } else {
                    $this->error[$key] = $result;
                }
            }
            if (true !== $result) {
                echo '00000';
               // throw new UnprocessableEntityHttpException(current($this->error));
            }
        }

        return $this;
    }

    /**
     * 验证单个字段规则
     * @access protected
     *
     * @param  string $field 字段名
     * @param  mixed  $value 字段值
     * @param  mixed  $rules 验证规则
     * @param  array  $data  数据
     * @param  string $title 字段描述
     *
     * @return mixed
     */
    protected function validateItem($field, $value, $rules, $data, $title = '')
    {
        $i = 0;
        foreach ($rules as $key => $rule) {
            if ($rule instanceof \Closure) {
                $result = call_user_func_array($rule, [$field, $value, $data, $title]);
            } else {
                // 判断验证类型
                list($type, $rule, $info) = $this->getValidateType($key, $rule);
                if ($type === 'is') {
                    $result = $this->is($field, $rule, $value, $data);
                } else {
                    $result = call_user_func_array([$this, $type], [$value, $rule]);
                }
            }
            if (false === $result) {
                $message = $this->getRuleMsg($field, $title, $info, $rule);

                return $message;
            } elseif (true !== $result) {
                // 返回自定义错误信息
                return $result;
            }
            $i++;
        }

        return $result;
    }

    /**
     * 获取当前验证类型及规则
     * @access public
     *
     * @param  mixed $key
     * @param  mixed $rule
     *
     * @return array
     */
    protected function getValidateType($key, $rule)
    {
        if (method_exists($this, $key)) {
            $type = $key;
            $info = $key;
        } else {
            $type = 'is';
            $info = $rule;
        }

        return [$type, $rule, $info];
    }

    /**
     * 验证字段值是否为有效格式
     * @access public
     *
     * @param  mixed  $value 字段值
     * @param  string $rule  验证规则
     * @param  array  $data  验证数据
     *
     * @return bool
     */
    public function is($field, $rule, $value, $data = [])
    {
        switch ($rule) {
            case 'require':
                // 必须
                $result = !empty($value) || '0' == $value;
                break;
            case 'number':
                $result = ctype_digit((string)$value);
                break;
            case 'boolean':
                // 是否为布尔值
                $result = in_array($value, [true, false, 0, 1, '0', '1'], true);
                break;
            case 'accepted':
                $result = in_array($value, ['1', 'on', 'yes']);
                break;
            case 'array':
                // 是否为数组
                $result = is_array($value);
                break;
            case 'date':
                // 是否是一个有效日期
                $result = false !== strtotime($value);
                break;
            case 'dnsrr':
                // 是否为有效的网址
                $result = checkdnsrr($value);
                break;
            case 'alphaNum':
                $result = ctype_alnum($value);
                break;
            default:
                if (function_exists('ctype_' . $rule)) {
                    //根据ctype验证
                    $ctypeFunc = 'ctype_' . $rule;
                    $result    = $ctypeFunc($value);
                } elseif (isset($this->filter[$rule])) {
                    // Filter_var验证，包括ip,email,integer,url,macAddr,float
                    $result = $this->filter($value, $this->filter[$rule]);
                } else {
                    // 正则验证
                    $result = $this->regex($value, $rule);
                }
        }

        return $result;
    }

    /**
     * 验证是否和某个字段的值是否不同
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     * @param  array $data  数据
     *
     * @return bool
     */
    public function different($value, $rule)
    {
        return $value != $rule;
    }

    /**
     * 验证是否大于等于某个值
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function egt($value, $rule)
    {
        return $value >= $rule;
    }

    /**
     * 验证是否大于某个值
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function gt($value, $rule)
    {
        return $value > $rule;
    }

    /**
     * 验证是否小于等于某个值
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function elt($value, $rule)
    {
        return $value <= $rule;
    }

    /**
     * 验证是否小于某个值
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function lt($value, $rule)
    {
        return $value < $rule;
    }

    /**
     * 验证是否等于某个值
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function eq($value, $rule)
    {
        return $value == $rule;
    }

    /**
     * 验证是否在范围内
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function in($value, $rule)
    {
        return in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * 验证是否不在某个范围
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function notIn($value, $rule)
    {
        return !in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * between验证数据
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function between($value, $rule)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        list($min, $max) = $rule;

        return $value >= $min && $value <= $max;
    }

    /**
     * 使用notbetween验证数据
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function notBetween($value, $rule)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        list($min, $max) = $rule;

        return $value < $min || $value > $max;
    }

    /**
     * 验证数据长度
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function length($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } else {
            $length = mb_strlen((string)$value);
        }
        if (strpos($rule, ',')) {
            // 长度区间
            list($min, $max) = explode(',', $rule);

            return $length >= $min && $length <= $max;
        }

        // 指定长度
        return $length == $rule;
    }

    /**
     * 验证数据最大长度
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function max($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } else {
            $length = mb_strlen((string)$value);
        }

        return $length <= $rule;
    }

    /**
     * 验证数据最小长度
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function min($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } else {
            $length = mb_strlen((string)$value);
        }

        return $length >= $rule;
    }

    /**
     * 验证日期
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function after($value, $rule)
    {
        return strtotime($value) >= strtotime($rule);
    }

    /**
     * 验证日期
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function before($value, $rule)
    {
        return strtotime($value) <= strtotime($rule);
    }

    /**
     * 使用正则验证数据
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则 正则规则或者预定义正则名
     *
     * @return bool
     */
    public function regex($value, $rule)
    {
        if (isset($this->regex[$rule])) {
            $rule = $this->regex[$rule];
        }
        if (0 !== strpos($rule, '/') && !preg_match('/\/[imsU]{0,4}$/', $rule)) {
            // 不是正则表达式则两端补上/
            $rule = '/^' . $rule . '$/';
        }

        return is_scalar($value) && 1 === preg_match($rule, (string)$value);
    }

    /**
     * 验证时间和日期是否符合指定格式
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function dateFormat($value, $rule)
    {
        $info = date_parse_from_format($rule, $value);

        return 0 == $info['warning_count'] && 0 == $info['error_count'];
    }

    /**
     * 验证是否有效IP
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则 ipv4 ipv6
     *
     * @return bool
     */
    public function ip($value, $rule)
    {
        if (!in_array($rule, ['ipv4', 'ipv6'])) {
            $rule = 'ipv4';
        }

        return $this->filter($value, [FILTER_VALIDATE_IP, 'ipv6' == $rule ? FILTER_FLAG_IPV6 : FILTER_FLAG_IPV4]);
    }

    /**
     * 使用filter_var方式验证
     * @access public
     *
     * @param  mixed $value 字段值
     * @param  mixed $rule  验证规则
     *
     * @return bool
     */
    public function filter($value, $rule)
    {
        if (is_string($rule) && strpos($rule, ',')) {
            list($rule, $param) = explode(',', $rule);
        } elseif (is_array($rule)) {
            $param = isset($rule[1]) ? $rule[1] : null;
            $rule  = $rule[0];
        } else {
            $param = null;
        }

        return false !== filter_var($value, is_int($rule) ? $rule : filter_id($rule), $param);
    }

    /**
     * 获取数据值
     * @access protected
     *
     * @param  array  $data 数据
     * @param  string $key  数据标识 支持二维
     *
     * @return mixed
     */
    protected function getDataValue($data, $key)
    {
        if (is_numeric($key)) {
            $value = $key;
        } else {
            $value = isset($data[$key]) ? $data[$key] : null;
        }

        return $value;
    }

    /**
     * 获取验证规则的错误提示信息
     * @access protected
     *
     * @param  string $attribute 字段英文名
     * @param  string $title     字段描述名
     * @param  string $type      验证规则名称
     * @param  mixed  $rule      验证规则数据
     *
     * @return string
     */
    protected function getRuleMsg($attribute, $title, $type, $rule)
    {
        if (isset($this->message[$attribute . '.' . $type])) {
            $msg = $this->message[$attribute . '.' . $type];
        } elseif (isset($this->message[$attribute][$type])) {
            $msg = $this->message[$attribute][$type];
        } elseif (isset($this->message[$attribute])) {
            $msg = $this->message[$attribute];
        } elseif (isset(self::$typeMsg[$type])) {
            $msg = self::$typeMsg[$type];
        } else {
            $msg = $attribute . '.' . $type . '没有设置错误提示';
        }
        if (empty($title)) {
            $title = $attribute;
        }
        if (is_string($msg) && is_scalar($rule) && false !== strpos($msg, ':')) {
            // 变量替换
            if (is_string($rule) && strpos($rule, ',')) {
                $array = array_pad(explode(',', $rule), 3, '');
            } else {
                $array = array_pad([], 3, '');
            }
            $msg = str_replace([':attribute', ':rule', ':1', ':2', ':3'],
                [$title, (string)$rule, $array[0], $array[1], $array[2]], $msg);
        }

        return $msg;
    }

    /**
     * 动态方法 直接调用is方法进行验证
     * @access public
     *
     * @param  string $method 方法名
     * @param  array  $args   调用参数
     *
     * @return bool
     */
    public function __call($method, $args)
    {
        if ('is' == strtolower(substr($method, 0, 2))) {
            $method = substr($method, 2);
        }
        array_push($args, lcfirst($method));

        return call_user_func_array([$this, 'is'], $args);
    }

    public static function check($data, $rules = [], $messages = [])
    {
        return (new Validator())->validate($data, $rules, $messages);
    }
}
