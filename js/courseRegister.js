

function print_back_values(course_name,course_number,course_description, course_image){
document.getElementById("course_name").value= course_name;
document.getElementById("course_number").value= course_number;
document.getElementById("course_description").value= course_description;
document.getElementById("course_image").value= course_image;
}

print_back_values(<?php $_SESSION['course_name'] ?> , <?php $_SESSION['course_number'] ?> ,<?php $_SESSION['course_description'] ?>, <?php $_SESSION['image_name']  ?>)
