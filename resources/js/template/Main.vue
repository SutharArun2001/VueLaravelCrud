<script>

import { ref } from 'vue';
const count = ref(0);
const text = ref('');
const checkedNames = ref([]);
const itemss = [
        {name: 'arun'},
        {name: 'kuldeep'}
];
const items = ref(itemss);


// function incre() {
//     count.value++
// }
// function setText(e) {
//     text.value = e.target.value;
// }
export default {
    
    data() {
        return {
            items:items,
            classObjects:{
                active:true,
                hasError:true,
            },
            count: count,
            text: text,
            checkedNames:checkedNames
        }
    },
    methods: {
        incre() {
            console.log('in methodvv');
            count.value++
        }, setText(e) {
            console.log('in methodvv');         
            text.value = e.target.value;
        }
    },computed: {
        selectedName : function(){
            console.log('in computed');
            return 'selected Name are :- ' + this.checkedNames;
        }
    }
    // created:function(){
    //     console.log("creted");
    // },
    // beforeCreate:function(){
    //     console.log("beforeCreted");
    // },
    // beforeMounte:function(){
    //     console.log("beforeMounted");
    // },
    // mounted:function(){
    //     console.log("mounted");
    // }
}
</script>
<template>
    <!-- {{ 'Aa' ? 'true' : 'false' }} -->
    <button v-on:click="incre">Count is :- {{ count }}</button>
    <button @click.ctrl="incre">Count is :- {{ count }}</button>
    <br>
    <!-- v-model is use to two way bi-->
    <input v-model="text" placeholder="enter text"><br>
    <!-- <input :value="text" v-on:input="setText" placeholder="enter text"><br> -->
    <span>{{ text }}</span>

    <h1 v-if="text == 'true'">true</h1>
    <h1 v-if="text == 'false'">true</h1>
    <!-- <h1 v-else>false</h1> -->
    <br>

    <input type="checkbox" id="1" value="Arun" v-model="checkedNames">
    <label for="arun">Arun</label>
    
    <input type="checkbox" id="2" value="John" v-model="checkedNames">
    <label for="john">John</label>
    
    <input type="checkbox" id="3" value="Mike" v-model="checkedNames">
    <label for="mike">Mike</label>

    <p>selected value are:- {{ checkedNames }} </p>
    <p class="static" :class=" {classObjects} ">selected value are:- {{ selectedName }} </p>

    <ul>
        <li v-for="(item ,index) in items" :key="item.name">{{index+"->"+ item.name }}</li>
    </ul>
</template>
