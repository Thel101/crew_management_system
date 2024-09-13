<script setup>
</script>
<template>
    <div>
        <form @submit.prevent="submit">
            <div class="flex flex-row justify-between">
                <div class="mr-5">
                    <InputLabel for="name" value="Vessel Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-5">
                    <InputLabel for="flag" value="Vessel Flag" />

                    <TextInput id="flag" type="text" class="mt-1 block w-full" v-model="form.flag" />

                    <InputError class="mt-2" :message="form.errors.flag" />
                </div>
                <div>
                    <InputLabel for="type" value="Vessel Type" />

                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="form.type" />

                    <InputError class="mt-2" :message="form.errors.type" />
                </div>
            </div>
            <div class="flex flex-row justify-between mt-4">

                <div>
                    <InputLabel for="IMO_num" value="IMO Number" />

                    <TextInput id="IMO_num" type="text" class="mt-1 block w-full" v-model="form.IMO_number" />

                    <InputError class="mt-2" :message="form.errors.IMO_number" />
                </div>
                <div>
                    <InputLabel for="built" value="Vessel Built Year" />

                    <TextInput id="built" type="text" class="mt-1 block w-full" v-model="form.built" />

                    <InputError class="mt-2" :message="form.errors.built" />
                </div>

                <div>
                    <InputLabel for="grt" value="GRT" />

                    <TextInput id="grt" type="text" class="mt-1 block w-full" v-model="form.GRT" />

                    <InputError class="mt-2" :message="form.errors.GRT" />
                </div>
            </div>

            <div class="flex flex-row justify-between mt-4">
                <div class="mr-3">
                    <InputLabel for="dwt" value="Vessel DWT" />

                    <TextInput id="dwt" type="text" class="mt-1 block w-full" v-model="form.DWT" />

                    <InputError class="mt-2" :message="form.errors.DWT" />
                </div>

                <div class="mr-3">
                    <InputLabel for="engine" value="Engine Make" />

                    <TextInput id="engine" type="text" class="mt-1 block w-full" v-model="form.Engine" />

                    <InputError class="mt-2" :message="form.errors.Engine" />
                </div>
                <div class="mr-3">
                    <InputLabel for="bhp" value="Vessel BHP" />

                    <TextInput id="bhp" type="text" class="mt-1 block w-full" v-model="form.BHP" />

                    <InputError class="mt-2" :message="form.errors.BHP" />
                </div>
                <div>
                    <InputLabel for="trade" value="Trade" />

                    <TextInput id="trade" type="text" class="mt-1 block w-full" v-model="form.Trade" />

                    <InputError class="mt-2" :message="form.errors.Trade" />
                </div>
            </div>


            <div class="flex justify-center mt-5">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create New Vessel
                </PrimaryButton>
            </div>


        </form>
    </div>
</template>
