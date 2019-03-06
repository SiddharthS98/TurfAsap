<template>
    <div :id="modalId" class="modal raleway">
        <div class="modal-content">
            <div class="row">
                <h4>Upload Image</h4>
                <hr>
            </div>
            <div class="row">
                <div class="col l6 s12 m12">
                    <div class="row raleway">Current Image</div>
                    <img :src="imageSrc" width="400" class="materialboxed responsive-img">
                </div>
                <div class="col l6 s12 m12">
                    <div class="row raleway">Selected Image</div>
                    <img :src="selectedImageSrc" width="400" class="materialboxed responsive-img">
                </div>
            </div>
            <div class="row">
                <form :name="formId" :id="formId" enctype='multipart/form-data'>
                    <div class="file-field input-field col l12 s12 m12">
                        <div class="btn">
                            <span>Image</span>
                            <input type="file" @change="onImageSelect" :id="inputFileId" name="image" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" v-model="image">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="btn waves-effect waves-light blue right" @click="commitChanges">Upload <i class="material-icons right">file_upload</i></div>
                <div class="btn waves-effect waves-light btn-flat red-text left" @click="deleteImage">Delete <i class="material-icons right">delete</i></div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn red" >Close</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type'],

        data() {
            return {
                data : {},
                time : '',
                image : '',
                selectedImageSrc : '',
            }
        },

        computed : {
            modalType () {
                return `${this.type}-image-upload`;
            },
            modalId () {
                return `${this.modalType}-modal`;
            },
            formId () {
                return `${this.modalType}-form`;
            },
            inputFileId() {
                return `${this.type}-file`;
            },
            imageUrl () {
                return `api/${this.type}/${this.data.id}/image`;
            },
            imageSrc () {
                return this.imageUrl + "#" + this.time;
            },
            uploadedImage () {
                return this.image.substr(this.image.lastIndexOf("\\")+1);
            },
            isSelected () {
                return this.image == "";
            }
        },

        mounted () {
            this.initModal();
        },

        methods : {
            onImageSelect () {
                this.selectedImageSrc = URL.createObjectURL(window.$.makeArray(window.$('#'+this.inputFileId).prop('files'))[0]);
                this.image = window.$('#'+this.inputFileId).val();
            },
            initModal () {
                this.$parent.$on(`upload-image-item`,this.onLoadModal);
            },
            onLoadModal (data) {
                this.refreshUrl();
                this.data = data.data;
                this.resetContent();
                this.openModal();
            },
            openModal () {
                window.$('#'+this.modalId).modal().modal('open');
            },
            commitChanges () {
                window.NProgress.start();
                let data = new FormData(document.getElementById(this.formId));
                let url = this.imageUrl;
                axios.post(url,data)
                    .then( (response) => {
                        window.NProgress.done();
                        if(response.data.success) {
                            window.success("Image Uploaded");
                            this.refreshUrl();
                            this.resetContent();
                        } else {
                            window.error("Failed to Upload Image");
                        }
                    })
                    .catch( (response) => {
                        window.error("Error while Uploading Image");
                        window.logError(response);
                    });
            },
            refreshUrl () {
                this.time = new Date().getTime();
            },
            resetContent () {
                this.image = "";
                this.selectedImageSrc = '';
            },
            deleteImage () {
                window.NProgress.start();
                let url = this.imageUrl;
                axios.delete(url)
                    .then ( (response) => {
                        window.NProgress.done();
                        if(response.data.success) {
                            window.success("Image Deleted");
                        } else {
                            window.error("Failed to Delete Image");
                        }
                        this.refreshUrl();
                    })
                    .catch ( (response) => {
                        window.error("Error while Deleting Image");
                        window.logError(response);
                    });
            }
        },

        filters: {
            capitalize(value) {
                return value.charAt(0).toUpperCase() + value.slice(1);
            }
        }
    }
</script>

<style>

</style>