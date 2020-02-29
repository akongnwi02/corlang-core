import {shallowMount} from '@vue/test-utils';
import Layout from '../../resources/js/frontend/layouts/Layout';

describe('Layout', () => {
    let wrapper;

    beforeEach(() => {
        wrapper = shallowMount(Layout);
    });

    it('should say purchase', function () {
        expect(wrapper.html()).toContain("Purchase");
    });
});
