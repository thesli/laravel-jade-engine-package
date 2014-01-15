<?php namespace Man\Jade;
class Jade
{
    public static function render($jadefile, $params=[])
    {
        $jade_bin = "/usr/bin/jade"; // if you don't know what it is type `which jade` in your terminal
        $jade_tpl_path = app_path() . '/jade/'; //enter your template path here,defaulted for laravel at app/jade/
        $jadefile = rtrim($jadefile,".jade"); // work for people who use ".jade" extension

        /*just in case people do something funky and break the code*/
        $jade_bin = escapeshellarg($jade_bin);
        $fullpath = escapeshellarg("{$jade_tpl_path}{$jadefile}.jade");
        $params_json = escapeshellarg(json_encode($params));

        $command = "{$jade_bin} < {$fullpath} --path {$jade_tpl_path}d --obj {$params_json}";
        $output = shell_exec($command);
        if($output){
            return $output;
        }else{
            $output = shell_exec($command . " 2>&1");
            $params = json_encode($params,JSON_PRETTY_PRINT);
            if($output){
                return "<pre><h5>command:<br/>{$command}</h5><h5>params:{$params}<br/></h5><h5>Issue:{$output}</h5></pre>";
            }else{
                return "<pre><h5>command:<br/>{$command}</h5><h5>params:{$params}<br/></h5><h5>Issue:<br>probably file not found(please check if file {$fullpath} exists)</h5></pre>";
            }
        }
    }
}