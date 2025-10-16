
<div>
<form action="/auth/register" method="POST" enctype="multipart/form-data">
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
    </div>
    <button type="submit">Register</button>
</form>
</div>