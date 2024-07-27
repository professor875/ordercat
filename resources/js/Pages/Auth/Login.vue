<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import DefaultAuthCard from "@/Components/Auths/DefaultAuthCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import MailSvg from "@/assets/svg/light/MailSvg.vue";
import LockSvg from "@/assets/svg/light/LockSvg.vue";
import GoogleSvg from "@/assets/svg/GoogleSvg.vue";
import {trans} from "../../utils.js";


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen flex justify-center items-center">
        <DefaultAuthCard subtitle="Start for free" title="Sign In to TailAdmin">
            <form @submit.prevent="submit">
                <TextInput label="Email" type="email" placeholder="Enter your email" v-model="form.email" class="mb-4.5">
                    <MailSvg/>
                </TextInput>

                <TextInput label="Password" type="password" placeholder="Enter your password" v-model="form.password">
                    <LockSvg/>
                </TextInput>

                <div class="mb-5 mt-6">
                    <input
                        type="submit"
                        value="Sign In"
                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90"
                    />
                </div>

                <button
                    class="flex w-full items-center justify-center gap-3.5 rounded-lg border border-stroke bg-gray p-4 font-medium hover:bg-opacity-70 dark:border-strokedark dark:bg-meta-4 dark:hover:bg-opacity-70"
                >
          <span>
            <GoogleSvg/>
          </span>
                    {{trans('Sign in with Google')}}
                </button>

                <div class="mt-6 text-center">
                    <p class="font-medium">
                        {{trans('Don’t have any account?')}}
                        <Link href="/auth/signup" class="text-primary">{{trans('Sign up')}}</Link>
                    </p>
                </div>
            </form>
        </DefaultAuthCard>
    </div>
</template>
