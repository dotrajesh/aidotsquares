wp.blocks.registerBlockType('chatgptai/custom-block',{
    title:'Chat Gpt AI',
    icon: 'shortcode',
    category:'widgets',
    edit: function () {
        
        return '<p>[chatgptai]</p>';
    },
    save: function () {
        return null;
    },
})