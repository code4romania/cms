/* eslint-disable */
<template>
    <a17-inputframe
        :error="error"
        :note="note"
        :label="label"
        :locale="locale"
        @localize="updateLocale"
        :size="size"
        :name="name"
        :required="required"
    >
        <ckeditor :editor="editor" :disabled="disabled" v-model="value" />
    </a17-inputframe>
</template>

<script>
    // eslint-disable
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import Editor from './dist/ckeditor.js';

    import debounce from 'lodash/debounce';

    import InputMixin from '@/mixins/input';
    import FormStoreMixin from '@/mixins/formStore';
    import InputframeMixin from '@/mixins/inputFrame';
    import LocaleMixin from '@/mixins/locale';

    export default {
        name: 'A17Ckeditor',
        components: {
            ckeditor: CKEditor.component,
        },
        mixins: [InputMixin, InputframeMixin, LocaleMixin, FormStoreMixin],
        props: {
            initialValue: {
                default: '',
            },
            options: {
                type: Object,
                required: false,
                default: () => ({}),
            },
        },
        computed: {
            editor: () => Editor,
        },
        data() {
            return {
                value: this.initialValue,
            };
        },
        watch: {
            value: debounce(function() {
                this.saveIntoStore();
            }, 300),
        },
    };
</script>
