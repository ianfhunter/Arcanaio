<template>
    
    <span class="ui tiny icon like-button-comments" v-on:click="like()" v-if="this.type === 'comment'">
      <i class="heart icon" :class="{ red: isLiked, loading: isLoading}"></i> <span class="like-counter">{{ likeCount }}</span>
    </span>
    <div class="ui labeled fluid button" id="like-button" v-on:click="like()" v-else>
      <div class="ui fluid button" :class="{ red: isLiked, loading: isLoading}">
        <i class="heart icon"></i> Like
      </div>
      <a class="ui basic left pointing label">
        {{ likeCount }}
      </a>
    </div>
   
</template>

<script>
export default {
    props: ['id', 'type', 'count', 'liked'],
    data (){
        return {
            likeCount: this.count,
            isLoading: '',
            isLiked: this.liked
        }        
    },
    methods: {
        like() {
            this.isLoading = true;
            this.$http.post('/like/'+this.type+'/'+this.id).then(response => {
                if(response.data.status == 'liked'){
                    this.likeCount++;
                    this.isLiked = true;                    
                }else if(response.data.status == 'unliked'){
                    this.likeCount--;
                    this.isLiked = false;                    
                }
            this.isLoading = false;
            }, response => {
                console.log(response.data)
            });
        }
    },
}
</script>