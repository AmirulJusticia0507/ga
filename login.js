const login = async(username, password) => {
    try {
        //create client
        $client = new GuzzleHttp\ Client();
        $response = $client - > request('POST', 'http://localhost/ga/', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);
        $body = json_decode($response - > getBody());
        // get token from response
        $jwt = $body - > jwt;
        //save jwt to storage
        localStorage.setItem('jwt', jwt);
        //redirect to appropriate page
        if (body.role === 'admin') {
            window.location.href = '/admin';
        } else {
            window.location.href = '/staff';
        }
    } catch (error) {
        console.log(error);
        alert('Login gagal');
    }
}

const jwt = localStorage.getItem('jwt');

const config = {
    headers: {
        'Authorization': `Bearer ${jwt}`
    }
}

const data = await axios.get('http://localhost/ga/', config);
console.log(data);