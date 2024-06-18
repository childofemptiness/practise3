<?php

class PostsController {

    private $posts;

    public function __construct(Posts $posts) {
        
        $this->posts = $posts;
    }

    public function index() {

        return $this->posts->findAll();
    }

    public function create($title, $content) {

        $this->posts->save([

            'title' => $title,

            'content' => $content,
        ]);
    }

    public function update($id, $title, $content) {

        $this->posts->update($id, [

            'title' => $title,

            'content' => $content,
        ]);
    }

    public function delete($id) {

        $this->posts->delete($id);
    }
}
