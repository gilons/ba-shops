<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                        {{ name }}
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"example-component",
        props:{
            name:{
                type:String,
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
