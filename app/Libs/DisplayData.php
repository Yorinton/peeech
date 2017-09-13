<?php

namespace App\Libs;

use App\Eloquent;

trait DisplayData
{
	//オブジェクトの配列をそのオブジェクト内の特定プロパティの配列に変換する
	public function objArrToPropArr($baseDatas,$column)//名前をobjArrToPropArr()とかに変える
	{
        $values = [];
        foreach ($baseDatas as $baseData) {
            $values[] = $baseData->$column;
        }
        return $values;
	}

	//暗号化された値を復号化
	public function decryptData($value){
          try{
            return $value = decrypt($value);
          }catch(\DecryptException $e){
            return $valuel ='';
          }
	}

	//ファイル名からページタイトルを生成
	// public function fileNameToTitle($filename)
	// {
	// 	switch ($filename) {
	// 		case 'profiles':
	// 			$title = 'プロフィール';
	// 			break;
	// 		default :
	// 			$title = 'Peeech';
	// 	}
	// 	return $title;
	// }

	//2つの配列の要素が同じが比較する
	public function identical_values( $arrayA , $arrayB ) { 

	    sort( $arrayA ); 
	    sort( $arrayB ); 

	    return $arrayA == $arrayB; 
	}

	public function getPref()
	{
		return array(
	        1 => '北海道',
	        2 => '青森県',
	        3 => '岩手県',
	        4 => '宮城県',
	        5 => '秋田県',
	        6 => '山形県',
	        7 => '福島県',
	        8 => '茨城県',
	        9 => '栃木県',
	        10 => '群馬県',
	        11 => '埼玉県',
	        12 => '千葉県',
	        13 => '東京都',
	        14 => '神奈川県',
	        15 => '山梨県',
	        16 => '長野県',
	        17 => '新潟県',
	        18 => '富山県',
	        19 => '石川県',
	        20 => '福井県',
	        21 => '岐阜県',
	        22 => '静岡県',
	        23 => '愛知県',
	        24 => '三重県',
	        25 => '滋賀県',
	        26 => '京都府',
	        27 => '大阪府',
	        28 => '兵庫県',
	        29 => '奈良県',
	        30 => '和歌山県',
	        31 => '鳥取県',
	        32 => '島根県',
	        33 => '岡山県',
	        34 => '広島県',
	        35 => '山口県',
	        36 => '徳島県',
	        37 => '香川県',
	        38 => '愛媛県',
	        39 => '高知県',
	        40 => '福岡県',
	        41 => '佐賀県',
	        42 => '長崎県',
	        43 => '熊本県',
	        44 => '大分県',
	        45 => '宮崎県',
	        46 => '鹿児島県',
	        47 => '沖縄県'
	        );
	}
}

?>