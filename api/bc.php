<?php

//$api_url = 'https://store-bwvr466.mybigcommerce.com/api/v2/products.json?category=502&limit=1&page=1';
class bc {
    
    public function getProduct($id) {
        $nid = (int) $id;
        
        $api_url = 'https://store-bwvr466.mybigcommerce.com/api/v2/products/' . $nid . '.json';
        $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, $api_url ); 
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('Accept: application/json', 'Content-Length: 0') );                                   
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 ); 
        curl_setopt( $ch, CURLOPT_USERPWD, "demo:df38dd10e9665a3cfa667817d78ec91ee9384bc3" ); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );   
        $response = curl_exec( $ch );   
        $result = json_decode($response); 
        
        $a = $result->id;
        
        
        
        $data['id'] = $result->id;
        //$data['name'] = $result->name;
        //$data['sku'] = $result->sku;
        /*echo $result->id;
        echo $result->name;
        echo '<br /><br />';
        var_dump($result); die();
        echo json_encode($result); */
        return $data;

    }
}


?>