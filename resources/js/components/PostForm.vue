<template>
    <div :class="'comment-form reply ' + reply_name" :id="'reply' + parent_id">
        <form @submit.prevent="sendData()" method="post">
            <div class="mb-3">
                <label :for="'message' + parent_id" class="form-label">Share your opinion</label>
                <input class="form-control comment-textarea" type="text" name="name" v-model="post.name" placeholder="fullname">
                <input type="hidden" name="parent_id" v-model="parent_id" />
            </div>
            <div class="mb-3">
                <textarea class="form-control comment-textarea" name="message" v-model="post.message" :id="'message' + parent_id" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn vt-btn-white">Send</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props : ['parent_id','reply_name'],
    data(){
        return {
            post : {
                name : null,
                message : null,
            }
        }
    },
    mounted() {
        this.post.parent_id = this.parent_id;
    },
    methods: {
        sendData(){
            axios.post('/api/comments',{name:this.post.name,message:this.post.message,parent_id:this.parent_id}).then((response) => {
                if (response.data.status === 1){
                    alert("Your comment was successfully submitted.");
                    this.$emit('event', response.data.comments);
                }else {
                    alert("error");
                }
                this.post.name      = "";
                this.post.message   = "";
            }).catch(error => {
                if (error.response.status === 422 && Object.values(error.response.data.errors)[0] !== undefined){
                    let [first] = Object.values(error.response.data.errors)[0];
                    alert(first);
                }else{
                    alert("send comment has error. please try again");
                }
            });
        },
    }
}
</script>
