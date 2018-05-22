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
        $c = mb_strlen($char);
        $arr = [];
        for ($i=0; $i<=$c; $i+=$width) {
            $arr[] = mb_substr($char, $i, $width);
        }
        return $arr;
    }
    public function create(Request $request){
        //1000x500の画像生成
        try {

        /**
         * 背景画像の作成
         */
        $im = imagecreate(1000, 500);
        //背景色決定
        $bg_colors = $this->baseColorPick[mt_rand(0, count($this->baseColorPick) - 1)];
        $bg = ImageColorAllocate($im, $bg_colors["r"], $bg_colors["g"], $bg_colors["b"]);
        //fontの指定
        $font = public_path("GenShinGothic-Bold.ttf");

        /**
         * 文字を変換
         */
        if(gd_info()["JIS-mapped Japanese Font Support"]){
            $convStr = mb_convert_encoding($request->get("title"),"SJIS", 'UTF-8');
        }else{
            $convStr = $request->get("title");
        }
        /**
         * 文字サイズの調整
         */

        switch (mb_strlen($convStr)){
            case mb_strlen($convStr) < 10:
                $size = 70;
                $width = 10;
                $arrText = $this->array_wordwrap($convStr, $width);
                break;
            case mb_strlen($convStr) < 30:
                $size = 50;
                $width = 15;
                $arrText = $this->array_wordwrap($convStr, $width);
                break;
            case mb_strlen($convStr) < 60:
                $size = 35;
                $width = 20;
                $arrText = $this->array_wordwrap($convStr, $width);
                break;
            case mb_strlen($convStr) < 100:
                $size = 30;
                $width = 25;
                $arrText = $this->array_wordwrap($convStr, $width);
                break;
            default:
                $size = 30;
                $width = 22;
                $arrText = $this->array_wordwrap($convStr, $width);
                break;
        }

        $countLine = count($arrText);

        $margin = 5;
        $height = ($size + $margin) * $countLine;
        $y = ((500 - $height) / 2);

        foreach($arrText as $val){
            //文字エリアの座標を取得する関数です
            $pos = imagettfbbox($size,0,$font,$val);

            //左右中央に持ってくるため、(画像幅-文字幅)/2を開始位置とします。
            $x = (1000 - ($pos[4] - $pos[6])) / 2;

            //imagettftextで実際に文字を生成する
            $font_color = ImageColorAllocate($im, $bg_colors["font_color"]["r"], $bg_colors["font_color"]["g"], $bg_colors["font_color"]["b"]);

            imagettftext($im, $size,0,$x,$y,$font_color,$font,$val);

            //縦方向の位置を文字サイズ＋行間分ずらす（これでline-height:2ぐらいになるはず）
            $y = $y - ($pos[7] - $pos[1]) + $margin + $size;
        }

        imagejpeg($im, public_path("poll_img/test.jpg"));

        $sData = $this->pollRepository->save($request->all());

        imagejpeg($im, public_path("poll_img/{$sData->id}.jpg"));
        //imagejpeg($im, public_path("poll_img/test.jpg"));
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
