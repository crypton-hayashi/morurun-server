<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class postData extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
  
		$headers = apache_request_headers();
		$uid = $headers["uid"];
		$type = $headers["type"];
		$comment = $headers["comment"];
		$latitude = $headers["latitude"];
		$longitude = $headers["longitude"];
		$location_id = $headers["location_id"];
        
        // posting_id
        $length = 6;
        $posting_id = date('mdHis');
        
        // file
        $uri = "http://morurun.tk/var/";
        if($type==1){
            $ext = "mov";
        }elseif($type==2){
            $ext = "jpg";
        }
        $contents_filename = "image_".$posting_id.".".$ext;
        $contents_filepath = $uri.$contents_filename;
        
        // datetime
        $datetime = date('Y-m-d H:i:s');
        
        // insert to database.
		$this->load->database();
		$dbdata = array(
            'posting_id' => $posting_id ,
            'user_id' => $uid ,
            'datetime' => $datetime ,
            'type_id' => $type ,
            'comment' => urldecode($comment) ,
            'url' => $contents_filepath ,
            'latitude' => $latitude ,
            'longitude' => $longitude ,
            'location_id' => $location_id ,
            );
        $test = $this->db->insert('t_posting', $dbdata);
        
		$body = file_get_contents('php://input');

		$fp = fopen("var/".$contents_filename, "w");
		fwrite($fp, $body);
		fclose($fp);
		
		$resoponse_obj = array("status" => "OK");
		$json_str = json_encode($resoponse_obj);
		$this->output->set_content_type('application/json');
		$this->output->set_output($json_str);
		$this->output->set_status_header(200);


    if($type==2){

        $contents_url = $contents_filepath;
        $comment =  urldecode($comment);

        require_once("./tmhOAuth/tmhOAuth.php");


        // 設定
        $api_key = '';		// APIキー
        $api_secret = '';		// APIシークレット
        $access_token = '';		// アクセストークン
        $access_token_secret = '';		// アクセストークンシークレット
        $request_url = 'https://upload.twitter.com/1.1/media/upload.json' ;		// エンドポイント
        $request_method = 'POST' ;

        // パラメータA (オプション)
        $params_a = array(
            //'media_data' => base64_encode(file_get_contents('/var/www/html/morurun/var/image_1114161814.jpg')) ,		// base64したデータ (どちらか必須)
            'media' => file_get_contents($contents_url) ,		// バイナリデータ (どちらか必須)
            //'additional_owners' => '' ,		// オーナーのID 
        ) ;

        // キーを作成する (URLエンコードする)
        $signature_key = rawurlencode( $api_secret ) . '&' . rawurlencode( $access_token_secret ) ;

        // パラメータB (署名の材料用)
        $params_b = array(
            'oauth_token' => $access_token ,
            'oauth_consumer_key' => $api_key ,
            'oauth_signature_method' => 'HMAC-SHA1' ,
            'oauth_timestamp' => time() ,
            'oauth_nonce' => microtime() ,
            'oauth_version' => '1.0' ,
        ) ;

        // リクエストURLにより、メディアを指定するパラメータが違う
        switch( $request_url )
        {
            case( 'https://api.twitter.com/1.1/account/update_profile_background_image.json' ) :
            case( 'https://api.twitter.com/1.1/account/update_profile_image.json' ) :
                $media_param = 'image' ;
            break ;

            case( 'https://api.twitter.com/1.1/account/update_profile_banner.json' ) :
                $media_param = 'banner' ;
            break ;

            case( 'https://upload.twitter.com/1.1/media/upload.json' ) :
                $media_param = ( isset($params_a['media']) && !empty($params_a['media']) ) ? 'media' : 'media_data' ;
            break ;
        }

        // イメージデータの取得
        $media_data = ( $params_a[ $media_param ] ) ? $params_a[ $media_param ] : '' ;

        // 署名の材料から、メディアデータを除外する
        if( isset( $params_a[ $media_param ] ) ) unset( $params_a[ $media_param ] ) ;

        // バウンダリーの定義
        $boundary = 's-y-n-c-e-r---------------' . md5( mt_rand() ) ;

        // POSTフィールドの作成 (まずはメディアのパラメータ)
        $request_body = '' ;
        $request_body .= '--' . $boundary . "\r\n" ;
        $request_body .= 'Content-Disposition: form-data; name="' . $media_param . '"; ' ;
        $request_body .= "\r\n" ;
        $request_body .= "\r\n" . $media_data . "\r\n" ;

        // POSTフィールドの作成 (その他のオプションパラメータ)
        foreach( $params_a as $key => $value )
        {
            $request_body .= '--' . $boundary . "\r\n" ;
            $request_body .= 'Content-Disposition: form-data; name="' . $key . '"' . "\r\n\r\n" ;
            $request_body .= $value . "\r\n" ;
        }

        // リクエストボディの作成
        $request_body .= '--' . $boundary . '--' . "\r\n\r\n" ;

        // リクエストヘッダーの作成
        $request_header = "Content-Type: multipart/form-data; boundary=" . $boundary ;

        // パラメータAとパラメータBを合成してパラメータCを作る → ×
    //	$params_c = array_merge( $params_a , $params_b ) ;
        $params_c = $params_b ;		// 署名の材料にオプションパラメータを加えないこと

        // 連想配列をアルファベット順に並び替える
        ksort( $params_c ) ;

        // パラメータの連想配列を[キー=値&キー=値...]の文字列に変換する
        $request_params = http_build_query( $params_c , '' , '&' ) ;

        // 一部の文字列をフォロー
        $request_params = str_replace( array( '+' , '%7E' ) , array( '%20' , '~' ) , $request_params ) ;

        // 変換した文字列をURLエンコードする
        $request_params = rawurlencode( $request_params ) ;

        // リクエストメソッドをURLエンコードする
        // ここでは、URL末尾の[?]以下は付けないこと
        $encoded_request_method = rawurlencode( $request_method ) ;

        // リクエストURLをURLエンコードする
        $encoded_request_url = rawurlencode( $request_url ) ;

        // リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
        $signature_data = $encoded_request_method . '&' . $encoded_request_url . '&' . $request_params ;

        // キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
        $hash = hash_hmac( 'sha1' , $signature_data , $signature_key , TRUE ) ;

        // base64エンコードして、署名[$signature]が完成する
        $signature = base64_encode( $hash ) ;

        // パラメータの連想配列、[$params]に、作成した署名を加える
        $params_c['oauth_signature'] = $signature ;

        // パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
        $header_params = http_build_query( $params_c , '' , ',' ) ;

        // リクエスト用のコンテキスト
        $context = array(
            'http' => array(
                'method' => $request_method , // リクエストメソッド
                'header' => array(			  // ヘッダー
                    'Authorization: OAuth ' . $header_params ,
                    'Content-Type: multipart/form-data; boundary= ' . $boundary ,
                ) ,
                'content' => $request_body ,
            ) ,
        ) ;

        // cURLを使ってリクエスト
        $curl = curl_init() ;
        curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
        curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
        curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
        curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
        curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
        curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
        curl_setopt( $curl , CURLOPT_POSTFIELDS , $context['http']['content'] ) ;			// リクエストボディ
        curl_setopt( $curl , CURLOPT_TIMEOUT , 50 ) ;										// タイムアウトの秒数
        $res1 = curl_exec( $curl ) ;
        $res2 = curl_getinfo( $curl ) ;
        curl_close( $curl ) ;

        // 取得したデータ
        $json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
        $header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

        // JSONをオブジェクトに変換
        $obj = json_decode( $json ) ;


        $media_id = $obj->media_id_string;

        //ツイートしたい文章
        $text = $comment;

        $tmhOAuth = new tmhOAuth(array(
         'consumer_key' => '', //コンシューマーキー
         'consumer_secret' => '', //コンシューマーシークレット
         'user_token' => '', //ユーザートークン
         'user_secret' => '', //ユーザーシークレット
        ));

        //画像付きでツイートする
        $tweet_update = $tmhOAuth->request(
         'POST', 
         'https://api.twitter.com/1.1/statuses/update.json', 
          array(
           'media_ids' => $media_id, 
           'status' => $text 
          )
        );

        //var_dump($obj);

        // HTML用
        $html = '' ;

        // タイトル
        $html .= '<h1 style="text-align:center; border-bottom:1px solid #555; padding-bottom:12px; margin-bottom:48px; color:#D36015;">media/upload</h1>' ;

        // エラー判定
        if( !$json || !$obj )
        {
            $html .= '<h2>エラー内容</h2>' ;
            $html .= '<p>データを取得することができませんでした…。設定を見直して下さい。</p>' ;
        }

        // 検証用
        $html .= '<h2>取得したデータ</h2>' ;
        $html .= '<p>下記のデータを取得できました。</p>' ;
        $html .= 	'<h3>ボディ(JSON)</h3>' ;
        $html .= 	'<p><textarea style="width:80%" rows="8">' . $json . '</textarea></p>' ;
        $html .= 	'<h3>レスポンスヘッダー</h3>' ;
        $html .= 	'<p><textarea style="width:80%" rows="8">' . $header . '</textarea></p>' ;

        // 検証用
        $html .= '<h2>リクエストしたデータ</h2>' ;
        $html .= '<p>下記内容でリクエストをしました。</p>' ;
        $html .= 	'<h3>URL</h3>' ;
        $html .= 	'<p><textarea style="width:80%" rows="8">' . $context['http']['method'] . ' ' . $request_url . '</textarea></p>' ;
        $html .= 	'<h3>ヘッダー</h3>' ;
        $html .= 	'<p><textarea style="width:80%" rows="8">' . implode( "\r\n" , $context['http']['header'] ) . '</textarea></p>' ;

        // フッター
        $html .= '<small style="display:block; border-top:1px solid #555; padding-top:12px; margin-top:72px; text-align:center; font-weight:700;">プログラムの説明: <a href="https://syncer.jp/twitter-api-matome/post/media/upload" target="_blank">SYNCER</a></small>' ;

        // 出力 (本稼働時はHTMLのヘッダー、フッターを付けよう)

        //echo $html ;
        }



	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */