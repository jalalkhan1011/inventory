<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Image;

trait ImageTraits
{
    private function upload($file, $title='')
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$title .'.'. $file->getClientOriginalExtension();
        Image::make($file)->resize(300,300)->save(public_path() . self::UPLOAD_DIR . $file_name);
        return $file_name;
    }

    private function unlink($file)
    {
        if ($file != '' && file_exists(public_path() . self::UPLOAD_DIR . $file)) {
            @unlink(public_path() . self::UPLOAD_DIR . $file);
        }
    }

    private function upload1($file, $title='')
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$title .'.'. $file->getClientOriginalExtension();
        Image::make($file)->resize(300,300)->save(public_path() . self::UPLOAD_DIR1 . $file_name);
        return $file_name;
    }

    private function unlink1($file)
    {
        if ($file != '' && file_exists(public_path() . self::UPLOAD_DIR1 . $file)) {
            @unlink(public_path() . self::UPLOAD_DIR1 . $file);
        }
    }

    private function uploadproject($file, $title='')
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$title .'.'. $file->getClientOriginalExtension();
        Image::make($file)->resize(900,650)->save(public_path() . self::UPLOAD_DIR . $file_name);
        return $file_name;
    }
}
