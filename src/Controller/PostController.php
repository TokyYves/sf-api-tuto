<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    public function __invoke(Post $data): Post 
    {
        $data->setUpdatedAt(new \DateTimeImmutable());
        return $data;
    }
} 
