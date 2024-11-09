<?php

namespace App\Providers\Helper;


class FormHelper
{
    /********************************************************  open *************************************************/
    public static function open($action = '', $method = 'POST', $attributes = [])
    {
        $method = strtoupper($method);
        $form = '<form action="' . htmlspecialchars($action, ENT_QUOTES) . '" method="' . $method . '"';
        foreach ($attributes as $key => $value) {
            $form .= sprintf(' %s="%s"', htmlspecialchars($key, ENT_QUOTES), htmlspecialchars($value, ENT_QUOTES));
        }
        $form .= '>';
        $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';

        return $form;
    }


    /********************************************************  text *************************************************/
    public static function text($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="text" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  password *************************************************/
    public static function password($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="password" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  number *************************************************/
    public static function number($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="number" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  file *************************************************/
    public static function file($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="file" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  hidden *************************************************/
    public static function hidden($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="hidden" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  email *************************************************/
    public static function email($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<input type="email" name="%s" value="%s" %s>',
            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($value, ENT_QUOTES),
            self::attributes($attributes)
        );
    }


    /********************************************************  submit *************************************************/
    public static function submit($label, $attributes = [])
    {
        $attributes['type'] = 'submit'; // Set the submit type

        return sprintf(
            '<button %s>%s</button>',
            self::attributes($attributes),
            htmlspecialchars($label, ENT_QUOTES)
        );
    }


    /********************************************************  button *************************************************/
    public static function button($label, $attributes = [])
    {
        $attributes['type'] = 'button'; // Set the button type
        return sprintf(
            '<button %s>%s</button>',
            self::attributes($attributes),
            htmlspecialchars($label, ENT_QUOTES)
        );
    }


    /********************************************************  label *************************************************/
    public static function label($text, $for = null, $attributes = [])
    {
        $attributesString = self::attributes($attributes);
        return sprintf('<label %s>%s</label>', $attributesString ? $attributesString . ' for="' . htmlspecialchars($for, ENT_QUOTES) . '"' : 'for="' . htmlspecialchars($for, ENT_QUOTES) . '"', htmlspecialchars($text, ENT_QUOTES));
    }


    /********************************************************  close *************************************************/
    public static function close()
    {
        return '</form>';
    }


    /********************************************************  attributes *************************************************/
    protected static function attributes($attributes)
    {
        return implode(' ', array_map(function ($key, $value) {
            return sprintf('%s="%s"', htmlspecialchars($key, ENT_QUOTES), htmlspecialchars($value, ENT_QUOTES));
        }, array_keys($attributes), $attributes));
    }


    /********************************************************  radio *************************************************/
    public static function radio($name, $value, $checked = false, $attributes = [])
    {
        $checkedAttribute = $checked ? 'checked' : '';
        return sprintf(
            '<input type="radio" name="%s" value="%s" %s %s>',
            htmlspecialchars($name, ENT_QUOTES),

            htmlspecialchars($value, ENT_QUOTES),
            $checkedAttribute,
            self::attributes($attributes)
        );
    }


    /********************************************************  dropdown *************************************************/
    public static function dropdown($name, $options = [], $selected = null, $attributes = [])
    {
        $optionsHtml = '';
        foreach ($options as $value => $label) {
            $isSelected = ($value == $selected) ? 'selected' : '';
            $optionsHtml .= sprintf(
                '<option value="%s" %s>%s</option>',
                htmlspecialchars($value, ENT_QUOTES),
                $isSelected,
                htmlspecialchars($label, ENT_QUOTES)
            );
        }
        return sprintf(
            '<select name="%s" %s>%s</select>',
            htmlspecialchars($name, ENT_QUOTES),
            self::attributes($attributes),
            $optionsHtml
        );
    }


    /********************************************************  textarea *************************************************/
    public static function textarea($name, $value = '', $attributes = [])
    {
        return sprintf(
            '<textarea name="%s" %s>%s</textarea>',
            htmlspecialchars($name, ENT_QUOTES),
            self::attributes($attributes),
            htmlspecialchars($value, ENT_QUOTES)
        );
    }
}
