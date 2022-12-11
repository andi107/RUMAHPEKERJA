<h2 style="color: #2e6c80;">Berikut data yang kami terima:</h2>
<table class="editorDemoTable" style="height: 127px;">
    <thead>
        <tr style="height: 18px;">
            <td style="width: 121px; height: 25px;"><strong>Host</strong></td>
            <td style="width: 414px; height: 25px;">{{ $data['host'] }}</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 121px; height: 18px;"><strong>Public IP</strong></td>
            <td style="width: 414px; height: 18px;">{{ $data['public_ip'] }}</td>
        </tr>
        <tr style="height: 22px;">
            <td style="width: 121px; height: 22px;"><strong>Broser</strong></td>
            <td style="width: 414px; height: 22px;"><span style="color: #008000;"><span style="font-size: 13px;">
                        {{ $data['browser'] }}
                </span></span></td>
        </tr>
        <tr style="height: 22px;">
            <td style="width: 121px; height: 22px;"><strong>Device</strong></td>
            <td style="width: 414px; height: 22px;"><span id="demoId">{{ $data['devices'] }}</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 121px; height: 18px;"><strong>Operation System</strong></td>
            <td style="width: 414px; height: 18px;">{{ $data['os'] }}</td>
        </tr>
        <tr style="height: 22px;">
            <td style="width: 121px; height: 22px;"><strong>User Agent</strong></td>
            <td style="width: 414px; height: 22px;"><strong>{{$data['user_agent']}}</strong></td>
        </tr>
    </thead>
</table>
<p><strong>&nbsp;</strong>
    Jika data diatas bukan anda, segeralah untuk 
    <span>
        <strong>
            <a href="https://www.rumahpekerjahebat.com/users/resetpassword?tt={{ $token }}"  style="color: #ff9900;text-decoration:none;">
                Ubah kata sandi!
            </a>
        </strong>
    </span>
</p>
<p><strong>&nbsp;</strong></p>
