<?php

namespace Helper;

use Illuminate\Support\Carbon;
use Form;


/**
 * to create dynamic fields-v2 for modules
 */
class FieldV2{
    public function isDeferred(){
        return false;
    }
    public static $months = [
        "1" => 'يناير',
        "2" => 'فبراير',
        "3" => 'مارس',
        "4" => 'أبريل',
        "5" => 'مايو',
        "6" => 'يونيو',
        "7" => 'يوليو',
        "8" => 'أغسطس',
        "9" => 'سبتمبر',
        "10" => 'أكتوبر',
        "11" => 'نوفمبر',
        "12" => 'ديسمبر'
    ];

    public static $hijriMonths = [
        "1" => 'محرم',
        "2" => 'صفر',
        "3" => 'ربيع الأول',
        "4" => 'ربيع الثاني',
        "5" => 'جمادى الأول',
        "6" => 'جمادى الآخرة',
        "7" => 'رجب',
        "8" => 'شعبان',
        "9" => 'رمضان',
        "10" => 'شوال',
        "11" => 'ذو القعدة',
        "12" => 'ذو الحجة'
    ];

    function __construct()
    {

    }

    /**
     * @return string
     */
    public static function langNavTabs()
    {
            return view('app::dashboard.fields-v2.lang-nav-tabs')->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @param array $options
     * @return string
     */
    public static function text($name, $label, $value = null,$options = [])
    {
        return view('app::dashboard.fields-v2.text',compact('name','label','value','options'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function dateTime($name, $label, $value = null)
    {
        return view('app::dashboard.fields-v2.date-time',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function time($name, $label, $value = null)
    {
        return view('app::dashboard.fields-v2.time',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $array
     * @return string
     */
    public static function number($name, $label, $value= null , $array = [])
    {
        $step = inArray('step' , $array , '0.01');

        return view('app::dashboard.fields-v2.number',compact('name','label','value','step'))->render();
    }

    /**
     * @param $name
     * @param $array
     * @param $type
     * @return string
     */
    public static function ajaxBtn($name, $array = [] , $type = 'submit')
    {
        $class = inArray('class' , $array , 'btn btn-primary');
        $id = inArray('id' , $array , 'ajax-button');

        return view('app::dashboard.fields-v2.ajax-btn',compact('name','class','type','id'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function email($name, $label,$value = null)
    {
        return view('app::dashboard.fields-v2.email',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function password($name, $label)
    {
        return view('app::dashboard.fields-v2.password',compact('name','label'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $plugin
     * @param $max
     * @param $min
     * @param $value
     * @return string
     */
    public static function datePicker($name, $label, $value = null ,$min = null , $max = null , $plugin = 'datepicker')
    {
        return view('app::dashboard.fields-v2.datepicker',compact('name','label','value','plugin','max','min'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $plugin
     * @return string
     */
    public static function date($name, $label, $value = null , $max = null , $min = null)
    {
        return view('app::dashboard.fields-v2.date',compact('name','label','value','max','min'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $options
     * @param string $plugin
     * @param string $placeholder
     * @param null $selected
     * @return string
     */
    public static function select($name, $label, $options, $selected = null , $plugin = 'select2', $placeholder = 'اختر قيمة')
    {
        return view('app::dashboard.fields-v2.select',compact('name','label', 'options' ,'selected','plugin','placeholder'))->render();
    }
    
    
    /**
     * @param $name
     * @param $label
     * @param $options
     * @param string $plugin
     * @param string $placeholder
     * @param null $selected
     * @return string
     */
    public static function multiFileUpload($name , $label , $plugin = "file_upload_preview")
    {
        return view('app::dashboard.fields-v2.multiFile-upload',compact('name','label','plugin'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @param $options
     * @return string+
     */
    public static function textarea($name, $label , $value = null , $options = [])
    {
        return view('app::dashboard.fields-v2.textarea',compact('name','label','value','options'))->render();
    }

    /**
     * summernote editor
     *
     * @param $name
     * @param $label
     * @param null $value
     * @param string $plugin
     * @return string
     */
    public static function editor($name, $label , $value = null , $plugin = 'summernote')
    {
        return view('app::dashboard.fields-v2.editor',compact('name','label','value','plugin'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @return string
     */
    public static function fileWithPreview($name, $label , $options = [])
    {
        return view('app::dashboard.fields-v2.file',compact('name','label' ,'options'))->render();
    }

    public static function checkBox($name, $label ,$options = [])
    {
        return view('app::dashboard.fields-v2.check-box',compact('name','label','options'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $options
     * @param null $checked
     * @return string
     */
    public static function radio($name, $label ,$options , $checked = null)
    {
        return view('app::dashboard.fields-v2.radio',compact('name','label','options','checked'))->render();
    }
}