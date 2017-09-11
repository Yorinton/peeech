<template>
	<div class="msg_cover msg_hide">
		<p>登録完了！</p>
	</div>
</template>
<style type="text/css">
	.msg_cover {
		text-align: center;
	    width: 100%;
	    padding: 10px 0;
	    height: 60px;
	    line-height: 40px;
	    font-size: 20px;
	    background: pink;
	    color: white;
	    margin-left: -6%;
	    z-index: 1000;
	}
	.msg_hide {
	    position: fixed;
	    top: -60px;
	   	transition-property:top;
	   	transition-duration:.6s;
		transition-timing-function:ease-in-out;
	}
	.msg_appear {
		top:0;
	   	transition-property:top;
	   	transition-duration:.6s;
		transition-timing-function:ease-in-out;
	}	
</style>