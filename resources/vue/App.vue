<template>
    <div id="appWrapper">
        <div class="container">
            <div class="search-box">
                <input 
                    type="text" 
                    v-model="query" 
                    name="q"
                    placeholder="Buscar un post..."
                    @input="onSearch">
                <ul 
                class="results-list"
                :class="resultVisibility">
                    <li 
                    v-for="post in posts" 
                    class="result-item"
                    :key="post.id">
                        <a href="#" class="result-link">
                            <div class="result-title">{{ post.title }}</div>
                            <div class="result-content">{{ post.content.substr(1, 80) }}</div>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur illum tempore quis unde error vero, ex delectus explicabo tempora aspernatur quae quasi provident quisquam nemo repudiandae perspiciatis eligendi minus? Placeat?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur illum tempore quis unde error vero, ex delectus explicabo tempora aspernatur quae quasi provident quisquam nemo repudiandae perspiciatis eligendi minus? Placeat?</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                query: '',
                resultVisibility: 'hidden',
                posts: []
            }
        },
        methods: {
            onSearch() {
                //if (this.query.length >= 3) {
                    axios.post('/posts/search', {
                        q: this.query
                    }).then(response => {
                        console.log(response.data);
                        this.posts = response.data.posts;
                    }).catch(error => {
                        console.log(error.response);
                    })
                //}
            }
        },
        computed: {
            resultVisibility() {
                return (this.query.length > 0) ? 'show' : 'hide';
            }
        }
    }
</script>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        color: #333;
    }
    ::-webkit-scrollbar {
        width: 10px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: #888;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }
    .search-box {
        position: relative;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .search-box input {
        background: #eee;
        width: 100%;
        max-width: 600px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        outline: none;
    }
    .search-box input:focus {
        border-color: #aaa;
    }
    .search-box .results-list {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 1px 2px 5px 0px #b5b5b5;
        display: none;
        height: 250px;
        list-style: none;
        width: 100%;
        max-width: 600px;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 10px;
        position: absolute;
        top: 30px;
        z-index: 1;
    }
    .search-box .results-list.show {
        display: block !important;
    }
    .search-box .results-list.hide {
        display: none !important;
    }
    .search-box .results-list .result-item {
        border-bottom: 1px solid #ddd;
    }
    .search-box .results-list .result-link {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 10px;
    }
    .search-box .results-list .result-link:hover {
        background-color: #f1f1f1;
    }
    .search-box .results-list .result-title {
        font-weight: bold;
        font-size: 18px;
        font-weight: 600;
    }
    .search-box .results-list .result-content {
        font-size: 16px;
    }
</style>