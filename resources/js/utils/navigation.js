import {usePage} from "@inertiajs/vue3";

const page = usePage();
export const isActive = (route) => {
    if (route === "/") {
        return page.url === route;
    }
    return page.url.startsWith(route)
};
