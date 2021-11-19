<template>
    <div :class="'comment ' + class_name">
        <div class="comment--body">
            <div class="commenter-avatar-wrap">
                <div class="commenter-avatar">
                    <img src="/images/user.jpg" alt="commenter avatar"/>
                    <a href="" class="stretched-link"></a>
                </div>
            </div>
            <div class="comment-text">
                <p class="comment-text-pragraph">
                    <a class="comment-user-text-link" href="#">
                        <span class="user-name" v-text="comment_body.name"></span>
                    </a>
                    <span class="comment-text-span" v-text="comment_body.message"></span>
                </p>
            </div>
        </div>
        <div class="comment--footer">
            <div class="comment--date"></div>
            <div class="comment--reactions">
                <button v-if="class_name !== 'is-thirdlayer'" class="btn vt-btn-white" @click="toggle_reply(comment_body.id)">
                    <span class="material-icons size-font"> reply </span>
                    <span>Replay</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['class_name','comment_body'],
    methods: {
        toggle_reply(id) {
            $("#reply" + id).toggle();
        },
    },
}
</script>
