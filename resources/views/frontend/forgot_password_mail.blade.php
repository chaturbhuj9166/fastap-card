<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <!--<br>-->
     <p>
		 <!--<button class="btn btn-primary">-->
			<!-- <a href="https://fastap.in/passwordreset/secret={{ base64_encode($email) }}" class="btn btn-primary">Reset Password</a>-->
		 <!--</button>-->
		 Change Password link: 
		 <!--<a href="https://fastap.in/passwordreset/secret={{ base64_encode($email) }}">Click here</a>-->
		 <!--<a href="{{ route('password.reset', ['email' => $email]) }}">Click here</a>-->
		 
        @php
        $encodedEmail = base64_encode($email);
        @endphp
        <a href="{{ route('password.reset', ['email' => $encodedEmail]) }}">Click here</a>
        

	 </p>
     <!--<br>-->
     <p>If you did not request a password reset, no further action is required.</p>
</div>