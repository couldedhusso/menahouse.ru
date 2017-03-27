<?php namespace  Menahouse\Contracts;

interface UserMailerInterface {

    public function Inbox();
    public function Sent();
    public function Liked();
    public function Deleted();
}
