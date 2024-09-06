<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;




// Configuration
$GPT4V_KEY = "316c3ec9247d49edb5b4e4c62f1f3158";
$GPT4V_ENDPOINT = "https://ai-aihubmay24dmc240313962815.openai.azure.com/openai/deployments/Pirategpt-4o/chat/completions?api-version=2024-02-15-preview";

// Ensure the upload directory exists
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Function to read the content of a .docx file
function readDocxFile($filePath) {
    try {
        $phpWord = IOFactory::load($filePath);
        $text = '';
        foreach ($phpWord->getSections() as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if ($element instanceof TextRun) {
                    foreach ($element->getElements() as $childElement) {
                        if ($childElement instanceof Text) {
                            $text .= $childElement->getText() . "\n";
                        }
                    }
                } elseif (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }
        return $text;
    } catch (Exception $e) {
        die('Error reading DOCX file: ' . $e->getMessage());
    }
}

// Function to read and encode image files
function readImageFile($filePath) {
    try {
        $imageData = file_get_contents($filePath);
        $base64 = base64_encode($imageData);
        return $base64;
    } catch (Exception $e) {
        die('Error reading image file: ' . $e->getMessage());
    }
}

// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $file_uploaded = isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK;

    $file_content = '';
    // Get the file details
    $file_tmp_path = $_FILES['file']['tmp_name'];
    $file_name = basename($_FILES['file']['name']);
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];

    // Sanitize the file name
    $file_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $file_name);

    // Save the uploaded file to the directory (optional)
    $uploaded_file_path = $upload_dir . $file_name;
    if (!move_uploaded_file($file_tmp_path, $uploaded_file_path)) {
        die('Failed to move the uploaded file.');
    }

    // Determine file type and read content
    $file_content = '';
    if (strpos($file_type, 'wordprocessingml.document') !== false) {
        $file_content = readDocxFile($uploaded_file_path);
        $file_content = htmlspecialchars($file_content); // Sanitize the content
    } elseif (strpos($file_type, 'image') !== false) {
        $file_content = readImageFile($uploaded_file_path);
    } else {
        die('Unsupported file type.');
    }

    // Get the form data
    $message = htmlspecialchars($_POST['message']);



    // Prepare the payload
    if ($file_uploaded) {
        if (strpos($file_type, 'image') !== false) {
            $payload = json_encode([
                "messages" => [
                    ["role" => "system", "content" => ""],
                    ["role" => "user", "content" => $message],
                    ["role" => "user", "content" => "I have uploaded an image: " . $file_name],
                    ["role" => "user", "content" => "Image content (base64):\n" . $file_content]
                ],
                "temperature" => 0.7,
                "top_p" => 0.95,
                "max_tokens" => 800
            ]);
        } else {
            $payload = json_encode([
                "messages" => [
                    ["role" => "system", "content" => ""],
                    ["role" => "user", "content" => $message],
                    ["role" => "user", "content" => "I have uploaded a file: " . $file_name],
                    ["role" => "user", "content" => "File content:\n" . $file_content]
                ],
                "temperature" => 0.7,
                "top_p" => 0.95,
                "max_tokens" => 800
            ]);
        }
    }
    else{
        $payload = json_encode([
            "messages" => [
                ["role" => "system", "content" => ""],
                ["role" => "user", "content" => $message],
            ],
            "temperature" => 0.7,
            "top_p" => 0.95,
            "max_tokens" => 800
        ]);
    }


    // Set up the headers
    $headers = [
        "Content-Type: application/json",
        "api-key: $GPT4V_KEY",
    ];

    // Initialize cURL
    $ch = curl_init($GPT4V_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Execute the request
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Failed to make the request. Error: ' . curl_error($ch));
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code >= 400) {
        die('HTTP Error: ' . $http_code . ' - ' . $response);
    }

    curl_close($ch);

    // Decode and display the response
    $response_data = json_decode($response, true);
    $content = htmlspecialchars($response_data['choices'][0]['message']['content']);

    echo "<h1>AI Response</h1>";
    echo "<p>" . $content . "</p>";
} else {
    // Display the form if no file is uploaded
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Upload File and Get AI Response</title>
    </head>
    <body>
    <h1>Upload File and Get AI Response</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="4" cols="50" required></textarea><br><br>
        <label for="file">Upload a file (optional, DOCX or image):</label>
        <input type="file" name="file" id="file"><br><br>
        <input type="submit" value="Send">
    </form>
    </body>
    </html>
    <?php
}
?>
