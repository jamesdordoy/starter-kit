declare module '@bhplugin/vue3-datatable' {
    import { DefineComponent } from 'vue';
    const Vue3Datatable: DefineComponent;
    export default Vue3Datatable;
    export interface Column {
        field: string;
        title: string;
        sort: boolean;
        width: string;
        align: 'left' | 'center' | 'right';
        format: (value: any) => string;
    }
}
