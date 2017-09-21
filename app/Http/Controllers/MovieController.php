<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/9/6
 * Time: 14:50
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;




class MovieController extends BaseController{
    public function search(Request $request){

        if($request->has('mov_name')){

            $mov_name=$request->input('mov_name');

            //字幕组，播放磁力链
            $data=array(
                "keyword"=>$mov_name
            );
            $res = curl_get("http://m.zimuzu.tv/search",'post',$data);

            $res_info= json_decode($res,true);

            $html=str_get_html($res_info['data']['resource_html']);

            $mov_info=array();
            foreach($html->find('li') as $key =>$val){
                $mov_info[$key]['href'] = $val->find('a',0)->href;//获取纯文本

                $mov_info[$key]['img_src'] = $val->find('img',0)->src;//获取纯文本

                $mov_info[$key]['mov_name'] = $val->find('p',0)->plaintext;//获取纯文本
            }


            //看美剧,调用播放器播放
            $kmj_list=curl_get("https://kanmeiju.herokuapp.com/api/search/".urlencode($mov_name));

            $kmj_item = json_decode($kmj_list,true);

            $kmj_info=$kmj_item['data']['results'];


            return view('movie_list',['move_list'=>$mov_info,'kmj_list'=>$kmj_info]);

        }else{
            echo 'Not found';
        }

    }
    //人人美剧分集列表
    public function resource($id){

        $res = curl_get("http://m.zimuzu.tv/resource/".$id);

        $html=str_get_html($res);

        $img=$html->find('img',1)->src;


$xx=array();
        foreach($html->find('#item1mobile .panel') as $key =>$res){

            $mov_info[$key]=$res->find('.panel-header',0)->plaintext;

            $arr[$key]=$html->find('.episode-list',$key)->outertext;

            preg_match_all('/<li data-itemid=\"(.*?)\"><a href=\"(.*?)\" class=\"aurl\"><span class=\"mui-badge\">(.*?)<\/a><\/span><\/li>/is',$arr[$key],$lt);

            $xx[$key]['sesson']=$mov_info[$key];

            foreach($lt[2] as $k =>$val){
                $href=explode('?',$val);
                    $xx[$key]['data'][$k]['href']=$href[1];
                }
            foreach($lt[3] as $x =>$v){
                $xx[$key]['data'][$x]['episode']=$v;
            }
        }

        if(count($xx)==0){
            $dy=array();
            foreach($html->find('#item1mobile') as $key =>$res){
                $dy[$key]['sesson']=trim($res->plaintext);
                $href=explode('?',$res->find('a',0)->href);
                $dy[$key]['href']=$href[1];
            }
            return view('resource',['episode_list'=>$dy,'cover'=>$img,'category'=>'dy']);
        }else{

            return view('resource',['episode_list'=>$xx,'cover'=>$img,'category'=>'dsj']);
        }

    }

    //在线播放剧集列表
    public function online($id){
        $episode=file_get_contents("https://kanmeiju.herokuapp.com/api/detail/".$id);
        $episode_list=json_decode($episode,true);
       // echo $episode_list['data']['season']['cover'];
        return view('online',['play_list'=>$episode_list['data']['season']['playUrlList'],'img'=>$episode_list['data']['season']['cover']]);
    }
    //播放页
    public function play($id){
        $video=file_get_contents("https://kanmeiju.herokuapp.com/api/m3u8/".$id);
        $video_info=json_decode($video,true);
        return view('play',['video_url'=>$video_info['data']['m3u8']['url']]);
    }
    //人人下载页
    public function download(Request $request){
        if($request->has('rid')){
            $rid=$request->input('rid');
            $season=$request->input('season');
            $episode=$request->input('episode');
            $url="http://m.zimuzu.tv/resource/item?rid=".$rid."&season=".$season."&episode=".$episode;
            $res=curl_get($url);
            $html=str_get_html($res);
            $title = $html->find('.mui-card-header',0)->plaintext;
            $s_title=isset($html->find('.mui-card-content-inner',0)->plaintext)?$html->find('.mui-card-content-inner',0)->plaintext:"";
            $item=array();
            $arr=array();
            $xs=array();
            $s_html=new \simple_html_dom();
            foreach($html->find('.download-links .mui-table-view-cell') as $key=>$res){
                $item[$key]['season']=$res->find('a',0)->plaintext;

                $arr[$key]=$html->find('.links',$key)->outertext;
               $s_res = $s_html->load($arr[$key]);

                $xs[$key]['season']=$item[$key]['season'];
                foreach($s_res->find('li') as $k => $v){
                    $xs[$key]['data'][$k]['text']=$v->plaintext;
                    $data_url=$v->find('a',0)->getAttribute('data-url');
                    if(substr($data_url,0,6)=='magnet' && !empty($data_url)){
                        $xs[$key]['online_mov']=$data_url;
                    }
                   $href = !empty($data_url)? $data_url:$v->find('a',0)->href;
                    $xs[$key]['data'][$k]['url']=$href;
                }
            }
            return view("download",['mov_down'=>$xs,'title'=>$title,'s_title'=>$s_title]);
        }else{
            echo '404';
        }




    }

    public function magnet(Request $request){
        if($request->has('url')){
            return view("play_magnet",['url'=>$request->input('url')]);
        }else{
            echo 404;
        }

    }
}