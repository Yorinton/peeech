<template>
    <div class="msg_error msg_hide_er">
        <p>登録失敗。文字数・形式をご確認下さい！</p>
    </div>
</template>
<style type="text/css">
    .msg_error {
        text-align: center;
        width: 100%;
        padding: 10px 0;
        height: 60px;
        line-height: 40px;
        font-size: 15px;
        background: #d71a18;
        color: white;
        margin-left: -6%;
        z-index: 1000;
    }
    .msg_hide_er {
        position: fixed;
        top: -90px;
        transition-property:top;
        transition-duration:.6s;
        transition-timing-function:ease-in-out;
    }
    .msg_appear_er {
        top:-20px;
        transition-property:top;
        transition-duration:.6s;
        transition-timing-function:ease-in-out;
    }
</style>