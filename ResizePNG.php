<?php

/**
 * Class ResizePNG
 */
class ResizePNG
{
    private string $filename;
    private int $width;
    private int $height;
    private int $quality;

    public function __construct(
        string $filename,
        int $width,
        int $height,
        int $quality = null
    ) {
        $this->filename = $filename;
        $this->width = $width;
        $this->height = $height;
        $this->quality =  $quality ?? 9;
    }

    public function resizeImage()
    {
        // получение новых размеров
        list($width_orig, $height_orig) = getimagesize($this->filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($this->width/$this->height > $ratio_orig) {
            $this->width = $this->height*$ratio_orig;
        } else {
            $this->height = $this->width/$ratio_orig;
        }

        // ресэмплирование
        $image_p = imagecreatetruecolor($this->width, $this->height);

        //Отключаем режим сопряжения цветов
        imagealphablending($image_p, false);

        //Включаем сохранение альфа канала
        imagesavealpha($image_p, true);

        $image = imagecreatefrompng($this->filename);

        imagecopyresampled(
            $image_p,
            $image,
            0,
            0,
            0,
            0,
            $this->width,
            $this->height,
            $width_orig,
            $height_orig
        );

        // todo генерировать уникальное название картинки. хранить в БД
        // todo путь для сохранинея
        // сохранение изображения по конкретному пути
        imagepng($image_p, __DIR__ . '\mini\\' . 'test.png', $this->quality);
    }
}