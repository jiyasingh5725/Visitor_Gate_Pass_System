<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the record to generate the pass
$id = $_POST['id'];

// Fetch the visitor details
$sql = "SELECT * FROM visitor_pass_form WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No record found.";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Visitor Pass</title>
    <link rel="stylesheet" href="generate_pass.css">
</head>
<body>
    <div class="pass-container" id="pass">
        <h1>Visitor Pass</h1>
        <div class="visitor-details">
            <p><strong>Visitor Pass No:</strong> <?php echo $row['visitor_pass_no']; ?></p>
            <p><strong>Day Pass No:</strong> <?php echo $row['day_pass_no']; ?></p>
            <p><strong>Visitor Name:</strong> <?php echo $row['visitor_name']; ?></p>
            <p><strong>Designation:</strong> <?php echo $row['designation']; ?></p>
            <p><strong>Company Name:</strong> <?php echo $row['company_name']; ?></p>
            <p><strong>Contact No:</strong> <?php echo $row['contact_no']; ?></p>
            <p><strong>Other Visitors:</strong> <?php echo $row['other_visitors']; ?></p>
            <p><strong>Duration (Hrs):</strong> <?php echo $row['duration']; ?></p>
            <p><strong>Visit Type:</strong> <?php echo $row['visit_type']; ?></p>
            <p><strong>Purpose:</strong> <?php echo $row['purpose']; ?></p>
        </div>
        <div class="photo-section">
            <h3>Visitor Photo</h3>
            <video id="video" autoplay></video>
            <canvas id="canvas" style="display: none;"></canvas>
            <button id="capture-btn">Capture Photo</button>
            <img id="photo" alt="Captured Photo" style="display: none;">
        </div>
    </div>
    <div class="actions">
        <button onclick="printPass()">Print</button>
        <button onclick="downloadPass()">Download</button>
    </div>

    <script>
        // Capture photo functionality
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const captureBtn = document.getElementById('capture-btn');

        // Access the device camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing camera: ", err);
            });

        // Capture photo
        captureBtn.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            photo.src = imageData;
            photo.style.display = 'block';
            canvas.style.display = 'none';
            video.style.display = 'none';
            captureBtn.style.display = 'none';
        });

        // Print pass
        function printPass() {
            const pass = document.getElementById('pass');
            const newWindow = window.open('', '', 'width=800,height=600');
            newWindow.document.write('<html><head><title>Print Visitor Pass</title></head><body>');
            newWindow.document.write(pass.outerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }

        // Download pass
        function downloadPass() {
            const pass = document.getElementById('pass');
            html2canvas(pass).then(canvas => {
                const link = document.createElement('a');
                link.download = 'visitor_pass.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>