<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button id="button" onclick="fetchData()">ask</button>
    <div>your message</div>
    <textarea name="request" id="request" cols="50" rows="10"></textarea>
    <div>ai response</div>
    <textarea name="response" id="response" cols="50" rows="10"></textarea>
    <script>
        async function fetchData() {

            const formData = new FormData();
            formData.append('request', document.querySelector('#request').value);

            try {
                const response = await fetch('http://127.0.0.1:8000/api/gpt', {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                const msg = data['message'];
                console.log(msg);

                let i = 0;
                for (let i = 0; i <= msg.length; i++) {
                    await wait(50);
                    document.getElementById('response').value = '';
                    document.getElementById('response').value = msg.slice(0, i);
                    i++;
                }

            } catch (error) {
                console.error('Error:', error)
            }
        }

        async function wait(ms) {
            return new Promise((resolve) => {
                setTimeout(resolve, ms);
            });
        }
    </script>
</body>

</html>