<?php
if (mail('lshteynblik@gmail.com.com', 'Test Subject', 'Test message')) {
    echo 'Test email sent.';
} else {
    echo 'Test email failed.';
}
?>