<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Product_model extends CI_Model
    {
        private $_table = "product";

        public $id_product;
        public $product_name;
        public $price;
        public $image = "default.jpg";
        public $description;
        
        public function rules()
        {
            return [
                [
                    'field' => 'product_name',
                    'label' => 'Name',
                    'rules' => 'required'

                ],

                [
                    'field' => 'price',
                    'label' => 'Price',
                    'rules' => 'numeric'
                ],

                [
                    'field' => 'description',
                    'label' => 'Description',
                    'rules' => 'required'
                ]
            ];
        }

        public function getAll()
        {
            return $this->db->get($this->_table)->result();
        }

        public function getById($id)
        {
            return $this->db->get_where($this->_table, ["id_product" => $id])->row();
        }

        public function save()
        {
            $post = $this->input->post();
            $this->id_product ="";
            $this->product_name = $post["product_name"];
            // memanggil method upload image
            $this->image = $this->_uploadImage();
            $this->price = $post["price"];
            $this->description = $post["description"];
            return $this->db->insert($this->_table, $this);
        }

        public function update()
        {
            $post = $this->input->post();
            $this->id_product = $post["id"];
            $this->product_name = $post["product_name"];
            
            if (!empty($_FILES["image"]["name"]))
            {
                $this->image = $this->_uploadImage();
            } else {
                $this->image = $post["old_image"];
            }

            $this->price = $post["price"];
            $this->description = $post["description"];
            return $this->db->update($this->_table, $this, array('id_product' => $post['id']));
        }

        public function delete($id)
        {
            $this->_deleteImage($id);
            return $this->db->delete($this->_table, array("id_product" => $id));
        }

        private function _uploadImage()
        {
            $config['upload_path']          = './upload/product';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = $this->id_product;
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                return $this->upload->data("file_name");
            }
            // print_r($this->upload->display_errors());
            return "default.jpg";
        }
        /* 
        
        Method _uploadImage() dijadikan private karena
        method ini hanya akan dipanggil melalui method update() dan save() 
        
        */

        private function _deleteImage($id)
        {
            $product = $this->getById($id);
            if($product->image != "default.jpg") {
                $filename = explode(".", $product->image)[0];
                return array_map('unlink', glob(FCPATH, "upload/product/$filename.*"));
            }
        }
    }


?>

