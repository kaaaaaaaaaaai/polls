<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollResource;
use App\Repositories\PollsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollController extends Controller
{
    const LIMIT = 12;

    private $baseColorPick;

    /**
     * PollController constructor.
     * @param PollsRepository $pollRepository
     */
    public function __construct(PollsRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
        $this->baseColorPick = config("basecolor");
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

    private function array_wordwrap($char, $width= 25){
        return  $this->mb_wordwrap(
            $char,
            $width,
            "\n",
            true
        );
    }
    public function create(Request $request){
        //1000x500の画像生成
        try {


            $im = imagecreate(1000, 500);
            //背景色決定
            $bg_colors = $this->baseColorPick[mt_rand(0, count($this->baseColorPick) - 1)];


            $bg = ImageColorAllocate($im, $bg_colors["r"], $bg_colors["g"], $bg_colors["b"]);
            $font1 = public_path("hs6.ttc");
            $str = $request->get("title");
            switch (mb_strlen($str)){
                case mb_strlen($str) < 10:
                    $size = 70;
                    $str = $request->get("title");
                    break;
                case mb_strlen($str) < 30:
                    $size = 50;
                    $width = 14;
                    $str = $this->array_wordwrap($request->get("title"), $width);
                    break;
                case mb_strlen($str) < 60:
                    $size = 40;
                    $width = 14;
                    $str = $this->array_wordwrap($request->get("title"), $width);
                    break;
                case mb_strlen($str) < 100:
                    $size = 30;
                    $width = 20;
                    $str = $this->array_wordwrap($request->get("title"), $width);
                    break;
                default:
                    $size = 25;
                    $width = 22;
                    $str = $this->array_wordwrap($request->get("title"), $width);
                    break;
            }
            //$this->array_wordwrap($request->get("title"), $width);
            $tb = imagettfbbox($size, 0, $font1, $str);

            $x = ceil((1000 - $tb[2]) / 2); //640は画像の幅
            $y = ceil((500 - $tb[3]) / 2); //640は画像の幅
            $font_color = ImageColorAllocate($im, $bg_colors["font_color"]["r"], $bg_colors["font_color"]["g"], $bg_colors["font_color"]["b"]);
            ImageTTFText($im, $size, 0, $x, $y, $font_color, $font1, $str);//size, angle,x,y,color,font,string

            $sData = $this->pollRepository->save($request->all());

            imagejpeg($im, public_path("poll_img/{$sData->id}.jpg"));
            //imagejpeg($im, public_path("poll_img/test.jpg"));
            return new JsonResponse([$sData], 200 );
        }catch (\Exception $e){
            return new JsonResponse(
                [
                    "error"=> "cant created"
                ],
                500 );
        }
    }
}
