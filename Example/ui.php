<?php

namespace Sized140;

const FOOTER = '
    <hr><footer>
    <ul>
      <li><a href="/"><b>homepage</b></a></li>
      <li><a href="/Mario"><b>/Mario</b></a></li>
      <li>check the 404 HTTP status code:<a href="/not/exists"><b>/not/exists</b></a></li>
    </footer>';

const TEMPLATE_HOME_PAGE = '<h1>Hello</h1>please click on the link on the footer to start:';

const TEMPLATE_POST = "<h1>{title}</h1> <p>{body}</p> <author>author: {author}</author>";

const TEMPLATE_GET = '
    <h1>Hello {author}<small> (pss..the name is on the url)</small></h1>
    Test the form and it\'s validator:
    <form name="input" action="/{author}" method="post">
    Title: <input type="text" name="title"><br>
    Body: <input type="text" name="body">
    <input type="submit" value="Submit">
    </form> ';

// with a DTO for the post
class PostBlogDTO
{
    public static $validation = ['title'  => ['string'],'body' => ['not-null']];

    public $title;
    public $body;
}

// The controller
class BlogController
{
    function __construct(Is $is)
    {
        $this->is = $is;
    }

    function homepage(){
        return render(TEMPLATE_HOME_PAGE.FOOTER);
    }

    //  $httpRequest is not needed here
    function get($author, $httpRequest)
    {
        if (empty($author)) {
            $author = 'you!';
        }
        return render(TEMPLATE_GET.FOOTER, ['author'=>$author]);
    }


    function post($author, $httpRequest)
    {
        // 1.map the DTO from the request
        $blogDTOFilled = form('\sized140\PostBlogDTO', $httpRequest);

        // 2. validate the DTO or exception
        if (count($err = $this->is->ok($blogDTOFilled, PostBlogDTO::$validation))>0) {
            throw new \Exception('Form is invalid! '.count($err).' errors found. Not satisfied regex: '.implode(';',$err));
        }

        // preparing the view
        $output['author'] = $author;
        $output['title'] = $blogDTOFilled->title;
        $output['body'] = $blogDTOFilled->body;

        // response the string
        return render(TEMPLATE_POST.FOOTER, $output);
    }
}