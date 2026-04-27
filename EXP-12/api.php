<?php
header('Content-Type: application/json');

$students = [
    ["id"=>1,  "name"=>"Ali",    "age"=>20, "marks"=>85, "course"=>"CS"],
    ["id"=>2,  "name"=>"Sara",   "age"=>22, "marks"=>72, "course"=>"IT"],
    ["id"=>3,  "name"=>"John",   "age"=>21, "marks"=>90, "course"=>"CS"],
    ["id"=>4,  "name"=>"Ayesha", "age"=>23, "marks"=>65, "course"=>"SE"],
    ["id"=>5,  "name"=>"David",  "age"=>20, "marks"=>78, "course"=>"IT"],
    ["id"=>6,  "name"=>"Rahul",  "age"=>21, "marks"=>88, "course"=>"CS"],
    ["id"=>7,  "name"=>"Priya",  "age"=>22, "marks"=>55, "course"=>"ECE"],
    ["id"=>8,  "name"=>"Karan",  "age"=>20, "marks"=>93, "course"=>"CS"],
    ["id"=>9,  "name"=>"Sneha",  "age"=>23, "marks"=>67, "course"=>"ME"],
    ["id"=>10, "name"=>"Rohit",  "age"=>21, "marks"=>81, "course"=>"IT"],
];

$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';
$course = isset($_GET['course']) ? $_GET['course'] : 'All';
$sortDesc = isset($_GET['sortDesc']) ? filter_var($_GET['sortDesc'], FILTER_VALIDATE_BOOLEAN) : false;

$filtered = array_filter($students, function($s) use ($search, $course) {
    if ($search !== "" && strpos(strtolower($s['name']), $search) === false) {
        return false;
    }
    if ($course !== "All" && $s['course'] !== $course) {
        return false;
    }
    return true;
});

$filtered = array_values($filtered);

if (isset($_GET['sortDesc'])) {
    usort($filtered, function($a, $b) use ($sortDesc) {
        if ($sortDesc) {
            return $b['marks'] <=> $a['marks'];
        } else {
            return $a['marks'] <=> $b['marks'];
        }
    });
}

echo json_encode($filtered);
?>
