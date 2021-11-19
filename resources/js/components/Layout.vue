<template>
    <div>
        <div class="comment-form">
            <post-form @event="updateComments" :parent_id="0"></post-form>
        </div>
        <template v-if="comments.length > 0"  v-for="comment in comments">
            <div class="comment-wrap" >
                <comment-template :comment_body="comment" class_name=""></comment-template>
                <post-form @event="updateComments" :parent_id="comment.id" reply_name=""></post-form>
                <template v-if="comment.sub_comments.length > 0" v-for="sub_cmn in comment.sub_comments">
                    <comment-template :comment_body="sub_cmn" class_name=""></comment-template>
                    <post-form @event="updateComments" :parent_id="sub_cmn.id" reply_name="is-secondlayer"></post-form>
                    <template v-if="sub_cmn.sub_comments.length > 0" v-for="sub_sub_cmn in sub_cmn.sub_comments">
                        <comment-template :comment_body="sub_sub_cmn" class_name="is-thirdlayer"></comment-template>
                    </template>
                </template>
            </div>
        </template>
    </div>
</template>

<script>
import axios from 'axios'
import CommentTemplate from './CommentTemplate.vue'
import PostForm from './PostForm.vue'
export default {
    data(){
      return {
          comments : {},
      }
    },
    mounted() {
        axios.get('/api/comments').then((response) => this.comments = response.data);
    },
    methods: {
        toggle_reply(id) {
            $("#reply" + id).toggle();
        },
        updateComments(params) {
            this.comments = {};
            this.comments = params;
        }
    },
    components : {
        PostForm,
        CommentTemplate
    }
}
</script>
