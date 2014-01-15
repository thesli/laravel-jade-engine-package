# Laravel Jade Templating Engine

This is my first Laravel package for my friend's Final Year Project,hope you like it.

## Requirement
- Laravel 4
- Jade executable (install from sudo npm install -g jade)
- *It may not work on windows machine(you can try cygwin and the like)

## Installation
In your composer.json add "man/jade": "dev-master" to require
#### composer.json
```json
{
	//...
	"require": {
		"laravel/framework": "*",
		"man/jade": "dev-master"
	},
	//...
}
```
Run the command composer update in terminal
#### bash
```bash
composer update
```
after that in app/config/app.php add 'Man\Jade\JadeServiceProvider' to 'providers' and 'Jade' => 'Man\Jade\Jade' to alias
#### app.php
```php
<?php
	'providers' => array(
    //......
		'Illuminate\Workbench\WorkbenchServiceProvider',
        'Man\Jade\JadeServiceProvider'
	),
    'aliases' => array(
    //.......
            'View'            => 'Illuminate\Support\Facades\View',
            'Jade'            => 'Man\Jade\Jade'
        ),
```

## Usage example

first create a app/jade folder
#### routes.php
```php
<?php
Route::get("/example",function(){
    $data = [
    "hello" => "You are welcome.",
    "welcome"=>true,
    "list"=>["item1,item2,item3"],
    "escapetxt"=>"<b>bold tags</b>"
    return Jade::render("example/index",$data);
});
```
note that the View::make('blah') will still work.
#### app/jade/example/index.jade
```jade
	if welcome
		ul
			for item in list
				li item
		h1 #{hello}
		p= escapetxt
		p!= escapetxt
	else
		h1 PLEASE LEAVE
```
#### html result
```html
	<ul>
		<li>item 1</li>
		<li>item 2</li>
		<li>item 3</li>
	</ul>
	<h1>You are welcome.</h1>
	<p>&lt;p&gt;bold tags&lt;/p&gt</p>
	<p><b>bold tags</b></p>
```
## Error Reporting

If you make mistake on your jade file,it will output error.
####example
```
   command:
   '/usr/bin/jade' < '/opt/lampp/htdocs/laravel/app/jade/index.jade' --path /opt/lampp/htdocs/laravel/app/jade/d --obj '{"some":"params"}'

   params:{
       "some": "params"
   }

   Issue:
   /usr/lib/node_modules/jade/lib/runtime.js:202
     throw err;
           ^
   Error: /opt/lampp/htdocs/laravel/app/jade/d:1
     > 1| !!!
       2| h1 deprecated error above ^_^

   `!!!` is deprecated, you must now use `doctype`
       at Object.Lexer.doctype (/usr/lib/node_modules/jade/lib/lexer.js:246:13)
       at Object.Lexer.next (/usr/lib/node_modules/jade/lib/lexer.js:827:15)
       at Object.Lexer.lookahead (/usr/lib/node_modules/jade/lib/lexer.js:111:46)
       at Parser.lookahead (/usr/lib/node_modules/jade/lib/parser.js:111:23)
       at Parser.peek (/usr/lib/node_modules/jade/lib/parser.js:88:17)
       at Parser.parse (/usr/lib/node_modules/jade/lib/parser.js:126:26)
       at parse (/usr/lib/node_modules/jade/lib/jade.js:95:62)
       at Object.exports.compile (/usr/lib/node_modules/jade/lib/jade.js:152:9)
       at ReadStream. (/usr/lib/node_modules/jade/bin/jade.js:126:21)
       at ReadStream.EventEmitter.emit (events.js:117:20)
```

## Customisation

change vendor/Man/Jade/Jade.php,you can edit the jade binary location and the app/jade folder to display the view
#### Jade.php
```php
$jade_bin = "/usr/bin/jade"; // if you don't know what it is type `which jade` in your terminal
$jade_tpl_path = app_path() . '/jade/'; //enter your template path here,defaulted for laravel at app/jade/
```

## License
MIT