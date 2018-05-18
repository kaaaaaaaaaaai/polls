<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollResource;
use App\Repositories\PollsRepository;
use Illuminate\Http\Request;

class PollController extends Controller
{
    const LIMIT = 12;
    /**
     * PollController constructor.
     * @param PollsRepository $pollRepository
     */
    public function __construct(PollsRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function recent()
    {
        $data = $this->pollRepository->getRecent(self::LIMIT);
        return PollResource::collection($data);
    }

    /**
     * @param $id
     * @return static
     */
    public function detail($id)
    {
        $detail = $this->pollRepository->find($id);
        return PollResource::make($detail);
    }


    public function popular(){
        $popular = $this->pollRepository->getPopular(self::LIMIT);
        return PollResource::collection($popular);
    }

    private function mb_wordwrap($string, $width=75, $break="\n", $cut = false) {
        if (!$cut) {
            $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
        } else {
            $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';
        }
        $string_length = mb_strlen($string,'UTF-8');
        $cut_length = ceil($string_length / $width);
        $i = 1;
        $return = '';
        while ($i < $cut_length) {
            preg_match($regexp, $string,$matches);
            $new_string = $matches[0];
            $return .= $new_string.$break;
            $string = substr($string, strlen($new_string));
            $i++;
        }
        return $return.$string;
    }

    private function array_wordwrap($char){
        return  $this->mb_wordwrap(
            $char,
            25,
            "\n",
            true
        );
    }
    public function create(){
        //1000x500の画像生成
        $im = imagecreate (1000, 500);
        //背景色決定
        $bg_colors = [
            "font_color" =>  [
                "r" => 255,
                "g" => 255,
                "b" => 255
            ],
            "r" => 42,
            "g" => 49,
            "b" => 52
        ];

        $bg = ImageColorAllocate ($im, $bg_colors["r"], $bg_colors["g"], $bg_colors["b"]);
        $size = 20;
//ThankU!
        $font1 = public_path("hs6.ttc");
        $str = $this->array_wordwrap("ああああああああああああああああああああああああああああいいいいいいいいいいいいいいいいいいいいいいいいうううううううううううううううううううううううううううううううううううううううううえええええええええええええええええええええええええええええええおおおおおおおおおおおおおおおおおおおおおおおおおおおかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかかきききききききききききききききききききききききききききききききききききききききききききききききき255");
        $tb = imagettfbbox($size, 0, $font1, $str);
        $x = ceil((1000 - $tb[2]) / 2); //640は画像の幅
        $y = ceil((500 - $tb[3]) / 2); //640は画像の幅
        $font_color = ImageColorAllocate ($im, $bg_colors["font_color"]["r"], $bg_colors["font_color"]["g"], $bg_colors["font_color"]["b"]);
        ImageTTFText ($im, $size, 0, $x, $y, $font_color, $font1, $str);//size, angle,x,y,color,font,string
        //$d = $this->themeRepository->save($request->all());
        imagejpeg($im, public_path("test.jpg"));
    }
}
