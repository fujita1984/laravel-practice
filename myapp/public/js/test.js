const messages = [];

async function fetchData() {

    const reqestMessage = document.querySelector('#request').value;
    messages.push({
        role: "user",
        content: reqestMessage
    });

    const formData = new FormData();
    formData.append("request", JSON.stringify(messages));

    try {
        const response = await fetch('http://127.0.0.1:8000/api/gpt', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();
        const msg = data['message'];
        messages.push({
            role: "assistant",
            content: msg
        });

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