<?php
header("Content-Type: text/html;charset=utf-8");
/*
function getdata($page=0){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://ncnu.bysjy.com.cn/module/getnotices?start=0&count=11&k=$page&type_id=7058");
	curl_setopt($curl, CURLOPT_HEADER, 0);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$data = json_decode(curl_exec($curl),true);
	return $data;
	curl_close($curl);
}


//ul>li方式打印数组
function ulli($arr)
{
        if(is_array($arr)){
            echo "<ul>";
            foreach ($arr as $k=>$v){

                if($k == "data"){

                    foreach ($arr['data'] as $j=>$m){

                        foreach ($m as $a=>$b){
                            if($a == "notice_name"){
                                echo '<li><a href='.$m['content_source_url'].">$b</a>&nbsp;<span>".$m['create_time'].'</span>';
                            }
                        }
                    }
                }
            }
            echo "</ul>";
        }else{
            return false;
        }

}
ulli(getdata(0));
*/

/*
新闻详情

*/


//$url为列表页url, 非解析后url
function img($url){
	//提取文章ID
	$data = parse_url($url);
	$params = explode("&",$data["query"]);
	$notice_id = explode("=", $params[0]);

	//curl获取内容
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://ncnu.bysjy.com.cn/detail/getnoticedetail?notice_id=".$notice_id[1]);
	curl_setopt($curl, CURLOPT_HEADER, 0);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = json_decode(curl_exec($curl),true);

	//curl正则匹配img
	$regImg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
	$res = preg_match_all($regImg,$data["data"]["content"],$matchAll);

	//图片输出
	foreach ($matchAll[0] as $key => $value) {
		echo $value;
	}
}
img("http://ncnu.bysjy.com.cn/detail/news?id=391473&menu_id=13308&type_id=7058");
?>