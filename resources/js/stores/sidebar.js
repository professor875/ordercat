import {reactive} from "vue";

export default reactive({
    isOpen: false,
    activeLabel: '',
    toggle() {
        this.isOpen = !this.isOpen
    },
    open() {
        this.isOpen = true;
    },
    close() {
        this.isOpen = false;
    },
    setActiveLabel(label) {
        this.activeLabel = label;
    }
})
