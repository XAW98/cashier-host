<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';



const form = useForm({
    verification_code: '',
});

const submit = () => {
    form.post(route('activation.verify'), {
        onFinish: () => form.reset('verification_code'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

            <div v-if='$page.props.error' class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4">
                <p class="font-bold"></p>
                <p>{{$page.props.error}}</p>
            </div>

            <div v-if='$page.props.message' class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                <p class="font-bold"></p>
                <p>{{$page.props.message}}</p>
            </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="verification_code" value="Verification Code" />
                <BreezeInput id="verification_code" type="text" class="mt-1 block w-full" v-model="form.verification_code" required autofocus autocomplete="verification_code" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Check Code
                </BreezeButton>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('resendCode')" method="post" class="underline text-sm text-gray-600 hover:text-gray-900">
                    resend code
                </Link>
            </div>

        </form>
    </BreezeGuestLayout>
</template>



<script>
export default {
    props: {
        message: String,
        error: String,
    },
}
</script>
