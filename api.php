<?php

$connection = mysqli_connect("localhost", "root", "", "htmx");
$post_title = $_POST['title'];
$post_body = $_POST['body'];

function render_html_elements($title, $body)
{
    echo "
        <div class='card mb-2 nh-post ' style='width: 18rem;'>
        <div class='card-body'>
        <h5 class='card-title'>$title</h5>
        <p class='card-text'>$body</p>
    </div>
    
    <div class='card-body'>
        <a href='#' class='card-link bg-danger text-light text-decoration-none p-2 rounded'>delete</a>
        <a href='#' class='card-link bg-success text-light text-decoration-none p-2 rounded'>update</a>
    </div>
        </div>";
}

switch ($_GET['action']) {
    case 'add_post':
        render_html_elements($post_title, $post_body);
        $query = "INSERT INTO posts(title, body) VALUES('$post_title', '$post_body')";
        mysqli_query($connection, $query);
        break;
    case 'get_post':
        $query = "SELECT * FROM posts";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            render_html_elements($row['title'], $row['body']);
        }
        break;
}

?>
