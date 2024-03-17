

<?php
if (isset($_FILES['files'])) {
    $errors = [];
    $uploadedFiles = [];
    $uploadPath = 'uploads/'; // Specify the directory to store the uploaded files
    $fileNames = $_FILES['files']['name'];
    $fileTmps = $_FILES['files']['tmp_name'];
    foreach ($fileNames as $key => $name) {
        $fileTmp = $fileTmps[$key];
        // Generate a unique filename to avoid conflicts
        $fileName = uniqid() . '_' . $name;
        // Move the uploaded file to the specified directory
        $destination = $uploadPath . $fileName;
        if (move_uploaded_file($fileTmp, $destination)) {
            $uploadedFiles[] = $destination;
        } else {
            $errors[] = "Failed to upload {$name}";
        }
    }
    if (!empty($errors)) {
        // Handle errors encountered during the upload process
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    if (!empty($uploadedFiles)) {
        // File upload succeeded
        // Perform further operations or display success message
        echo '<div id="container" class="container">';
        // Loop through the uploaded files and display them in rows of 3 cubes each
        $count = 0;
        foreach ($uploadedFiles as $file) {
            if ($count % 3 == 0) {
                echo '<div class="row">';
            }
            echo '<div class="cube"><img src="' . $file . '" style="height: 100px; width: auto;"></div>';
            $count++;
            if ($count % 3 == 0 || $count == count($uploadedFiles)) {
                echo '</div>'; // Close row div after every 3 cubes or at the end of files
            }
        }

     
        echo '</div>';
        echo '<button onclick="downloadimage()">Download</button>'; 
       }
}
?>



<style>

    .container {
        display: flex;
        
        
    

    }

    .row1{
        width: 100px;
    }

    .row2{
        width: 100px;
    }

    .row3{
        width: 100px;
    }


    .cube {
        background-size: contain;
        height: 100px;
        widht : 100px;
        margin : 10px;
        border: 2px solid black;
    
    }
</style>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script type="text/javascript">

            function downloadimage() {
                /*var container = document.getElementById("image-wrap");*/ /*specific element on page*/
                var container = document.getElementById("container");; /* full page */
                html2canvas(container, { allowTaint: true }).then(function (canvas) {

                    var link = document.createElement("a");
                    document.body.appendChild(link);
                    link.download = "html_image.jpg";
                    link.href = canvas.toDataURL();
                    link.target = '_blank';
                    link.click();
                    console.log("success");
                });
            }

        </script>