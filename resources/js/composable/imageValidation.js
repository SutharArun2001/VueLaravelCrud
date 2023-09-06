import { ref } from "vue";

export default function useImageValidation() {
    
    var previewImage = ref('');
    // var storagePath = '/storage/profiles/';
    let imageErrors = ref({
        profile:''
    });
    let file = ref([]);

    
    const validates = (e) => {
        imageErrors.value.profile = '';
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        file.value = e.target.files[0];

        if (!file.value) {
            imageErrors.value.profile = 'Please select an image file';
        }else if (!allowedTypes.includes(file.value.type)) {
            imageErrors.value.profile = 'Only jpeg, png, and gif are allowed';
        } else if (file.value.size > 1000000) {
            imageErrors.value.profile = 'File size too large. Maximum size is 500KB.';
        }

        if(imageErrors.value.profile.length != 0) {
            return imageErrors;
        }
        
        let reader = new FileReader();
        reader.onload = (e) => {
            previewImage.value = e.target.result;
        };
        reader.readAsDataURL(file.value);
    }

    return {
        validates,
        imageErrors,
        previewImage,
        // storagePath,
        file
    }
}