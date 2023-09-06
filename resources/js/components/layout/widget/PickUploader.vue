<script setup>
import { onMounted } from 'vue';
import imageValidate from '../../../composable/imageValidation';


var {validates, imageErrors, previewImage, file} = imageValidate();


defineProps({
    userProfile: {
        type: String,
    },

});

/**
* define emit events in array
*/
const emit = defineEmits([
    'file-value'
]);

function onImageChange(e) {
    validates(e);
    if(imageErrors.value.profile.length === 0) {
        emit('file-value', file);
    }
}

</script>
<template>
    <div>
        <img :src="previewImage ? previewImage : `${userProfile}`" alt="" srcset="">
        <input name="profile-path" type="file" @change="onImageChange" />
        <span v-if="imageErrors.profile" class="error">{{ imageErrors.profile }}</span>
    </div>
</template>

<style scoped>
form .user_details .image_pox{
    margin-bottom: 15px;
    margin: 12px 0;
    width: calc(100% / 2 - 20px);
}

.image_pox img {
    border-radius: 100%;
    width: 120px;
    height: 120px;
}

</style>