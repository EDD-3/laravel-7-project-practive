<?php

function validatePostForm(): array
{
    return request()->validate([
        'title' => 'required|min:8|max:255',
        'post_image' => 'required|file',
        'body' => 'required',
    ]);
}
