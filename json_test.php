<?php
$data = json_decode('[
  {
    "id": 8,
    "parent": 4,
    "name": "Food & Lifestyle"
  },
  {
    "id": 2,
    "parent": 1,
    "name": "Mobile Phones"
  },
  {
    "id": 1,
    "parent": 0,
    "name": "Electronics"
  },
  {
    "id": 3,
    "parent": 1,
    "name": "Laptops"
  },
  {
    "id": 5,
    "parent": 4,
    "name": "Fiction"
  },
  {
    "id": 4,
    "parent": 0,
    "name": "Books"
  },
  {
    "id": 6,
    "parent": 4,
    "name": "Non-fiction"
  },
  {
    "id": 7,
    "parent": 1,
    "name": "Storage"
  }
]',true);

$input = array_column($data, null, "id");
$input = array_map(function ($entry) {
    return (object) $entry;
}, $input);
$output = array_values(array_filter(array_map(function ($entry) use ($input) {
    if (!empty($entry->parent)) {
        $input[$entry->parent]->children[] = $entry;
        return null;
    }
    return $entry;
}, $input)));
echo '<pre>';
echo json_encode($output, JSON_PRETTY_PRINT);
echo '</pre>';

?>